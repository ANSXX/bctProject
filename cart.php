<?php

session_start();


if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    
    if(isset($_GET['delete'])) {
        $delete_index = $_GET['delete'];

        
        unset($_SESSION['cart'][$delete_index]);

        
        $_SESSION['cart'] = array_values($_SESSION['cart']);

        
        header("Location: cart.php");
        exit();
    }
} else {
    echo "Your cart is empty.";
    exit();
}


$totalSum = 0;
$totalItems = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        td a {
            color: #ff0000;
            text-decoration: none;
            font-weight: bold;
        }

        td a:hover {
            text-decoration: underline;
        }

        .total {
            text-align: center;
            margin-top: 20px;
            font-weight: bold;
        }

        .product-img {
            max-width: 50px;
            max-height: 50px;
        }
    </style>
</head>
<body>
    <h1>Shopping Cart</h1>
    <table>
        <thead>
            <tr>
                <th>Serial Number</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Remove</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($_SESSION['cart'] as $index => $item): ?>
                <tr>
                    <td><?php echo $index + 1; ?></td>
                    <td><?php echo $item['name']; ?></td>
                    <td><?php echo isset($item['description']) ? $item['description'] : 'Description not available'; ?></td>
                    <td><?php echo '$' . $item['price']; ?></td>
                    <td><a href="cart.php?delete=<?php echo $index; ?>">&#9747</a></td>
                </tr>
                <?php 
                    $totalSum += $item['price'];
                    $totalItems++;
                ?>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="total">
        Total Items: <?php echo $totalItems; ?> | Total Price: $<?php echo $totalSum; ?>
    </div>
</body>
</html>
