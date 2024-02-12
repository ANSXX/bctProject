<?php
// Start session
session_start();

// Check if the cart session variable exists and is not empty
if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    // Calculate total sum and total number of items
    $totalSum = 0;
    $totalItems = 0;
    foreach ($_SESSION['cart'] as $item) {
        $totalSum += $item['price'];
        $totalItems++;
    }
} else {
    // If cart is empty, redirect back to cart.php
    header("Location: cart.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Payment Details</h5>
            </div>
            <div class="card-body">
                <p>Total Items: <?php echo $totalItems; ?></p>
                <p>Total Price: $<?php echo $totalSum; ?></p>
                <form action="pay.php" method="post">
            <div>
                <div>

                    <fieldset>
                    <legend>
                    <h6>Enter your name</h6>
                    </legend>
                    
                        <input type="text" name="" id="" placeholder="enter your name">
                    </fieldset>
                
                    <fieldset>
                    <legend>
                    <h6>Enter your address</h6>
                    </legend>
                    
                        <input type="text" name="" id="" placeholder="enter your address">
                    </fieldset>        
                </div>
            </div>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="paymentMethod" id="upi" value="UPI" required>
                <label class="form-check-label" for="upi">
                    UPI
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="paymentMethod" id="cashOnDelivery" value="Cash On Delivery" required>
                <label class="form-check-label" for="cashOnDelivery">
                    Cash On Delivery
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="paymentMethod" id="netBanking" value="Net Banking" required>
                <label class="form-check-label" for="netBanking">
                    Net Banking
                </label>
            </div>
            <button type="submit" class="btn btn-primary">Proceed to Pay</button>
        </form>
            </div>
        </div>
    </div>
</body>
</html>
