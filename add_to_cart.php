<?php
session_start();

// Check if the form data is being received properly
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the product details from the form data
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_description = $_POST['product_description'];
    $product_price = $_POST['product_price'];
    
    // Create an array to store the product details
    $product = array(
        'id' => $product_id,
        'name' => $product_name,
        'description' => $product_description,
        'price' => $product_price
    );
    
    // Check if the cart session variable exists; if not, create it
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }
    
    // Add the product to the cart session variable
    $_SESSION['cart'][] = $product;

    // Send a success response
    echo json_encode(array('success' => true));
} else {
    // Send an error response if the request method is not POST
    echo json_encode(array('success' => false, 'message' => 'Invalid request method.'));
}
?>
