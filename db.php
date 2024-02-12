<?php
// Start session
session_start();

// Database connection
$servername = "localhost"; // Change this if your MySQL server is running on a different host
$username = "root"; // Change this to your MySQL username (default is 'root' in XAMPP)
$password = ""; // By default, XAMPP doesn't set a password for the root user
$dbname = "admin_ecom";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate input
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Query database
    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    
    // Select database before executing the query
    if ($conn->select_db($dbname)) {
        $result = $conn->query($sql);

        // If a matching record is found, set session and redirect
        if ($result->num_rows == 1) {
            // Fetch user details
            $row = $result->fetch_assoc();
            $_SESSION["user_id"] = $row["id"]; // Assuming 'id' is the primary key of the users table
            $_SESSION["username"] = $row["username"];
            // Redirect to dashboard or homepage
            header("Location: index.html"); // Change 'dashboard.php' to your desired page
        } else {
            // Invalid credentials, redirect back to login page with error message
            header("Location: login.php?error=invalid_credentials");
        }
    } else {
        echo "Error selecting database: " . $conn->error;
    }
}
?>
