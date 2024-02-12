<?php
include_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productId = $_POST["productId"];

    $sql = "DELETE FROM products WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    
    mysqli_stmt_bind_param($stmt, "i", $productId);

    if (mysqli_stmt_execute($stmt)) {
        echo "Product removed successfully.";
    } else {
        echo "Error: Unable to remove product.";
    }

    mysqli_stmt_close($stmt);
} else {
    echo "Form submission error: Request method not POST.";
}
?>
