import express from "express";
import fetch from "node-fetch";
import "dotenv/config";
import path from "path";
import cors from "cors";
import { get } from 'http';

const { PAYPAL_CLIENT_ID, PAYPAL_CLIENT_SECRET, PORT = 8888 } = process.env;
const base = "https://api-m.sandbox.paypal.com";
const app = express();
// host static files
app.use(cors());
app.use(express.static("client"));


// MY variables
var price = 0;
var date = 0;
var time = 0;
var paymentType = 0;
var serviceId = 0;
var userId = 0;
const urlCustom = `http://localhost:8000/reservation_done/${date}/${time}/${price}`;

const payload = {
  intent: "CAPTURE",
  purchase_units: [
    {
      amount: {
        currency_code: "USD",
        value: "30",
      },
    },
  ]
};

// parse post params sent in body in json format
app.use(express.json());

app.post("/api/orders", async (req, res) => {
  var comment = req.body.comment || 'NOT';
var additionalServices = req.body.additionalServices || 'NOT';
  try {
    price = req.body.price;
    date = req.body.date;
    time = req.body.time;
    paymentType = req.body.paymentType;
    serviceId = req.body.serviceId;
    userId = req.body.userId;
    if(req.body.comment !== '') comment = req.body.comment;
    if(req.body.additionalServices !== '')additionalServices = req.body.additionalServices;
    const urlCustom = `http://127.0.0.1:8000/reservation_done/`+date+"/"+time+"/"+price+"/"+paymentType+"/"+serviceId+"/"+userId+"/"+comment+"/"+additionalServices;
    console.log("CUSTOM URL" + urlCustom);
    get(urlCustom, (response) => {
      // Handle response if needed
      console.error('SUCCESS to trigger URL:', response);
    }).on('error', (error) => {
      console.error('Failed to trigger URL:', error);
    });
    // Now you can use the price data to create the order
    const { jsonResponse, httpStatusCode } = await createOrder(req.body);
    res.status(httpStatusCode).json(jsonResponse);
  } catch (error) {
    console.error("Failed to create orderss:", error);
    res.status(500).json({ error: "Failed to create orders." });
  }
});
/**
 * Generate an OAuth 2.0 access token for authenticating with PayPal REST APIs.
 * @see https://developer.paypal.com/api/rest/authentication/
 */
const generateAccessToken = async () => {
  try {
    if (!PAYPAL_CLIENT_ID || !PAYPAL_CLIENT_SECRET) {
      throw new Error("MISSING_API_CREDENTIALS");
    }
    const auth = Buffer.from(
      PAYPAL_CLIENT_ID + ":" + PAYPAL_CLIENT_SECRET,
    ).toString("base64");
    const response = await fetch(`${base}/v1/oauth2/token`, {
      method: "POST",
      body: "grant_type=client_credentials",
      headers: {
        Authorization: `Basic ${auth}`,
      },
    });

    const data = await response.json();
    return data.access_token;
  } catch (error) {
    console.error("Failed to generate Access Token:", error);
  }
};

/**
 * Create an order to start the transaction.
 * @see https://developer.paypal.com/docs/api/orders/v2/#orders_create
 */
const createOrder = async (cart) => {

  // use the cart information passed from the front-end to calculate the purchase unit details
  console.log(
    "shopping cart information passed from the frontend createOrder() callback:",
    time,
  );
  if (!isValidPrice(cart.price)) {
    console.error("Invalid price: " + cart.price);
  }else{
    console.error("Valid price: " + cart.price);
  }

  const accessToken = await generateAccessToken();
  const url = `${base}/v2/checkout/orders`;

  const response = await fetch(url, {
    headers: {
      "Content-Type": "application/json",
      Authorization: `Bearer ${accessToken}`,
      // Uncomment one of these to force an error for negative testing (in sandbox mode only). Documentation:
      // https://developer.paypal.com/tools/sandbox/negative-testing/request-headers/
      // "PayPal-Mock-Response": '{"mock_application_codes": "MISSING_REQUIRED_PARAMETER"}'
      // "PayPal-Mock-Response": '{"mock_application_codes": "PERMISSION_DENIED"}'
      // "PayPal-Mock-Response": '{"mock_application_codes": "INTERNAL_SERVER_ERROR"}'
    },
    method: "POST",
    body: JSON.stringify(payload),
  });

  return handleResponse(response);
};

/**
 * Capture payment for the created order to complete the transaction.
 * @see https://developer.paypal.com/docs/api/orders/v2/#orders_capture
 */
const captureOrder = async (orderID) => {
  const accessToken = await generateAccessToken();
  const url = `${base}/v2/checkout/orders/${orderID}/capture`;

  const response = await fetch(url, {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      Authorization: `Bearer ${accessToken}`,
      // Uncomment one of these to force an error for negative testing (in sandbox mode only). Documentation:
      // https://developer.paypal.com/tools/sandbox/negative-testing/request-headers/
      // "PayPal-Mock-Response": '{"mock_application_codes": "INSTRUMENT_DECLINED"}'
      // "PayPal-Mock-Response": '{"mock_application_codes": "TRANSACTION_REFUSED"}'
      // "PayPal-Mock-Response": '{"mock_application_codes": "INTERNAL_SERVER_ERROR"}'
    },
  });
  return handleResponse(response);
};

async function handleResponse(response) {
  try {
    const jsonResponse = await response.json();
    return {
      jsonResponse,
      httpStatusCode: response.status,
    };
  } catch (err) {
    const errorMessage = await response.text();
    throw new Error(errorMessage);
  }
}

app.post("/api/orders", async (req, res) => {
  try {
    // use the cart information passed from the front-end to calculate the order amount detals
    const { cart } = req.body;
    const { jsonResponse, httpStatusCode } = await createOrder(cart);
    res.status(httpStatusCode).json(jsonResponse);
  } catch (error) {
    console.error("Failed to create order:", error);
    res.status(500).json({ error: "Failed to create order." });
  }
});

app.post("/api/orders/:orderID/capture", async (req, res) => {
  try {
    const { orderID } = req.params;
    const { jsonResponse, httpStatusCode } = await captureOrder(orderID);
    console.log(price + date + time + "Lempa");
    const additionalData = {
      time: time,
      date: date,
      price: price
    };
    // Combine additional data with jsonResponse
    const updatedResponse = { ...jsonResponse, ...additionalData };
    console.log(
      "orderis",
      updatedResponse,)
    res.status(httpStatusCode).json(jsonResponse);
  } catch (error) {
    console.error("Failed to create order:", error);
    res.status(500).json({ error: "Failed to capture order." });
  }
});

// serve index.html
app.get("/", (req, res) => {
  res.sendFile(path.resolve("./client/checkout.html"));
});

app.listen(PORT, () => {
  console.log(`Node server listening at http://localhost:${PORT}/`);
});

const isValidPrice = (price) => {
  // Implement your price validation logic here
  return typeof price === "number" && price > 0;
};