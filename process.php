<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include database connection
include_once 'db.php';

// Check if form is submitted for product upload or login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the 'product' key exists in $_POST array
    if (isset($_POST['product'])) {
        // Get selected product from the form
        $selected_product = $_POST['product'];

        // Default values for demonstration
        $name = "";
        $description = "";
        $price = 0;
        $image = "";

        // Determine product details based on selected_product
        if ($selected_product == 'a') {
            $name = "Product A";
            $description = "This is product A description.";
            $price = 10;
            $image = "product_a.png";
        } elseif ($selected_product == 'b') {
            $name = "Product B";
            $description = "This is product B description.";
            $price = 20;
            $image = "product_b.png";
        }

        // File upload
        $target_dir = "uploads/";
        $target_file = $target_dir . $image;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["file"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["file"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                // Insert data into database using prepared statements to prevent SQL injection
                $sql = "INSERT INTO products (name, description, price, image) VALUES (?, ?, ?, ?)";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "ssds", $name, $description, $price, $image);
                if (mysqli_stmt_execute($stmt)) {
                    header("Location: display.php");
                    exit();
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
                mysqli_stmt_close($stmt);
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } elseif (isset($_POST['email']) && isset($_POST['password'])) { // Check if email and password are submitted
        // Retrieve email and password from form
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Check email and password against database (for demonstration, assume email and password are correct)
        $correctEmail = "example@example.com";
        $correctPassword = "password123";

        if ($email === $correctEmail && $password === $correctPassword) {
            // Redirect to success page or perform further actions
            header("Location: success.php");
            exit();
        } else {
            // Display error message and redirect back to login page
            $errorMessage = "Incorrect email or password. Please try again.";
            header("Location: login.php?error=" . urlencode($errorMessage));
            exit();
        }
    } else {
        echo "Invalid request.";
    }
} else {
    // If the form is not submitted, redirect back to the appropriate page
    // For example, if there's no specific page to redirect to, you can redirect to the homepage
    header("Location: index.php");
    exit();
}
?>