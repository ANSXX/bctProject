<?php

session_start();


$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "admin_ecom";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $email = $_POST["email"];
    $password = $_POST["password"];

    
    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    
    
    if ($conn->select_db($dbname)) {
        $result = $conn->query($sql);

        
        if ($result->num_rows == 1) {
            
            $row = $result->fetch_assoc();
            $_SESSION["user_id"] = $row["id"]; 
            $_SESSION["username"] = $row["username"];
            
            header("Location: index.html"); 
        } else {
            
            header("Location: login.php?error=invalid_credentials");
        }
    } else {
        echo "Error selecting database: " . $conn->error;
    }
}
?>
