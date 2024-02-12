<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "admin_ecom";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productId = $_POST["productId"];
    $productName = $_POST["productName"];
    $productPrice = $_POST["productPrice"];
    $productDescription = $_POST["description"];

    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["productImage"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["productImage"]["tmp_name"]);
    if($check === false) {
        echo "<script>alert('File is not an image.')</script>";
        $uploadOk = 0;
    }

    if ($_FILES["productImage"]["size"] > 500000) {
        echo "<script>alert('Sorry, your file is too large.')</script>";
        $uploadOk = 0;
    }

    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.')</script>";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "<script>alert('Sorry, your file was not uploaded.')</script>";
    } else {
        if (move_uploaded_file($_FILES["productImage"]["tmp_name"], $target_file)) {
            $sql = "INSERT INTO products (name, price, image, description) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sds", $productName, $productPrice, $target_file, $productDescription);
            
            if ($stmt->execute()) {
                echo "<script>alert('Product added successfully.')</script>";
            } else {
                echo "<script>alert('Error: " . $sql . "<br>" . $conn->error . "')</script>";
            }
        } else {
            echo "<script>alert('Sorry, there was an error uploading your file.')</script>";
        }
    }
}

$sql = "SELECT id, name, price FROM products";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Add Product</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Add Product</h5>
            </div>
            <div class="card-body">
                <form action="admin.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="productName">Product Name</label>
                        <input type="text" class="form-control" id="productName" name="productName" required>
                    </div>
                    <div class="form-group">
                        <label for="productPrice">Product Price</label>
                        <input type="text" class="form-control" id="productPrice" name="productPrice" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" class="form-control" id="description" name="description" required>
                    </div>
                    <div class="form-group">
                        <label for="productImage">Product Image</label>
                        <input type="file" class="form-control-file" id="productImage" name="productImage" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Product</button>
                </form>
            </div>
        </div>

        <div class="card mt-5">
            <div class="card-header">
                <h5 class="card-title">Remove Product</h5>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product ID</th>
                            <th>Product Name</th>
                            <th>Product Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row["id"] . "</td>";
                                echo "<td>" . $row["name"] . "</td>";
                                echo "<td>" . $row["price"] . "</td>";
                                echo "<td><a href='remove_product.php?id=" . $row["id"] . "' class='btn btn-danger'>Remove</a></td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4'>No products available</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
