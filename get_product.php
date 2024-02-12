<?php
// Database connection
$servername = "localhost"; // Change this if your MySQL server is running on a different host
$username = "root"; // Change this to your MySQL username
$password = ""; // Change this to your MySQL password
$dbname = "admin_ecom"; // Change this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch products from database
$sql = "SELECT id, name, price, image FROM products"; // Adjust this query based on your database schema

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Array to store products
    $products = array();

    // Fetch products and add them to the products array
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }

    // Output products as JSON
    echo json_encode($products);
} else {
    // If no products found
    echo "No products found";
}

// Close database connection
$conn->close();
?>
