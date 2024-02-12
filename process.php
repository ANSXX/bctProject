<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


include_once 'db.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (isset($_POST['product'])) {
        
        $selected_product = $_POST['product'];

        
        $name = "";
        $description = "";
        $price = 0;
        $image = "";

        
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

        
        $target_dir = "uploads/";
        $target_file = $target_dir . $image;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        
        $check = getimagesize($_FILES["file"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        
        if ($_FILES["file"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                
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
    } elseif (isset($_POST['email']) && isset($_POST['password'])) { 
        
        $email = $_POST['email'];
        $password = $_POST['password'];

        
        $correctEmail = "example@example.com";
        $correctPassword = "password123";

        if ($email === $correctEmail && $password === $correctPassword) {
            
            header("Location: success.php");
            exit();
        } else {
            
            $errorMessage = "Incorrect email or password. Please try again.";
            header("Location: login.php?error=" . urlencode($errorMessage));
            exit();
        }
    } else {
        echo "Invalid request.";
    }
} else {
    
    
    header("Location: index.php");
    exit();
}
?>