<?php
// Start session
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Watches.co</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inria+Sans:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: "Inria Sans";
            font-weight: 700;
            font-style: italic;
        }

        body > nav {
            display: grid;
            grid-template-columns: auto auto auto;
            align-items: start;
            background-color: #2d57cacd;
            font-family: Inria sans;
            font-weight: 900;
            font-style: normal;
            display: grid;
            grid-template-columns: auto auto auto;
            justify-content: space-between; /* Add this line to push the items to the sides */
            padding: 10px; /* Add padding for better spacing */
        }

        img.cart-icon {
            width: 40px;
            height: 40px;
            justify-self: end; /* Align to the end of the container */
        }

        div.navbar-container {
            justify-self: start; /* Align to the start of the container */
        }
        div a{
            color: #000;
        }
    </style>
</head>
<body>
    <nav>
        <div>
            <?php
            // Check if user is logged in
            if (isset($_SESSION['user_id'])) {
                echo '<a href="logout.php"><h6>Logout</h6></a>';
            } else {
                echo '<a href="login.php"><h6>Login</h6></a>';
            }
            ?>
        </div>
        <div class="navbar-container">
            <h1 class="navbar">Watches.co</h1>
        </div>
        <div> 
            <a href="cart.php" class="ms-3">
                <img src="cart.png" alt="Shopping Cart" class="cart-icon">
            </a>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="card-group">
            <!-- Product cards go here -->
        </div>
    </div>

    <!-- Include jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.addToCartButton').click(function() {
                var formId = $(this).data('form');
                var formData = $('#' + formId).serialize();

                $.ajax({
                    type: 'POST',
                    url: 'add_to_cart.php', // Change this to the correct URL for adding to cart
                    data: formData,

                    error: function(xhr, status, error) {
                        // Handle errors here
                        console.error(error);
                    }
                });
            });
        });
    </script>
</body>
</html>
