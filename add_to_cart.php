<?php
session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_description = $_POST['product_description'];
    $product_price = $_POST['product_price'];
    
    
    $product = array(
        'id' => $product_id,
        'name' => $product_name,
        'description' => $product_description,
        'price' => $product_price
    );
    
    
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }
    
    
    $_SESSION['cart'][] = $product;

    
    echo json_encode(array('success' => true));
} else {
    
    echo json_encode(array('success' => false, 'message' => 'Invalid request method.'));
}
?>
