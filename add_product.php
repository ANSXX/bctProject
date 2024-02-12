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

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productId = $_POST["productId"];
    $productName = $_POST["productName"];
    $productPrice = $_POST["productPrice"];

    // File upload handling
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["productImage"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["productImage"]["tmp_name"]);
    if($check === false) {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["productImage"]["size"] > 500000) {
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
        // Attempt to upload file
        if (move_uploaded_file($_FILES["productImage"]["tmp_name"], $target_file)) {
            // File uploaded successfully, insert product into database
            $sql = "INSERT INTO products (id, name, price, image) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("isds", $productId, $productName, $productPrice, $target_file);
            
            if ($stmt->execute()) {
                echo "Product added successfully.";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

// Close database connection
$conn->close();
?>
