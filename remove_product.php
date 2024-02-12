<?php
// Include database connection
include_once 'db.php';

// Check if form is submitted via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve product ID from form data
    $productId = $_POST["productId"];

    // Remove product from database
    $sql = "DELETE FROM products WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    
    // Bind product ID parameter
    mysqli_stmt_bind_param($stmt, "i", $productId);

    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        // Product removed successfully
        echo "Product removed successfully.";
    } else {
        // Error handling
        echo "Error: Unable to remove product.";
    }

    // Close the statement
    mysqli_stmt_close($stmt);
} else {
    // If form is not submitted via POST method
    echo "Form submission error: Request method not POST.";
}
?>
