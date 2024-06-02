<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    // Klasė skirta 
    public function createOrder()
    {
        // Generate order data
        $orderData = [
            'amount' => '100.00' // Replace with your actual amount
        ];

        // Return order data as JSON
        return response()->json($orderData);
    }
}