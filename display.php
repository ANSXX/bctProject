<?php

session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Watches.co</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https:
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https:
    <link rel="preconnect" href="https:
    <link href="https:
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
            justify-content: space-between;
            padding: 10px;
        }

        img.cart-icon {
            width: 40px;
            height: 40px;
            justify-self: end;
        }

        div.navbar-container {
            justify-self: start;
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
    <script src="https:
    <script>
        $(document).ready(function() {
            $('.addToCartButton').click(function() {
                var formId = $(this).data('form');
                var formData = $('#' + formId).serialize();

                $.ajax({
                    type: 'POST',
                    url: 'add_to_cart.php', 
                    data: formData,

                    error: function(xhr, status, error) {
                        
                        console.error(error);
                    }
                });
            });
        });
    </script>
</body>
</html>
