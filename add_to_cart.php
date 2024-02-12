<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_data = $_POST['product'];
    $_SESSION['cart'][] = $product_data;
    echo json_encode(array('success' => true));
} else {
    echo json_encode(array('success' => false, 'message' => 'Invalid request method.'));
}
?>
