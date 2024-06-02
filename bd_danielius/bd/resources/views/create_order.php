<?php
// Generate order data
$orderData = [
    'amount' => '100.00' // Replace with your actual amount
];

// Return order data as JSON
header('Content-Type: application/json');
echo json_encode($orderData);
?>