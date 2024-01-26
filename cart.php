<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Your Cart</h2>
<?php session_start(); ?>

<div id="cart-container">
    <?php

    // Remove item from the cart
    if (isset($_POST['remove'])) {
        $remove_index = $_POST['remove'];
        if (isset($_SESSION['cart'][$remove_index])) {
            // Decrease quantity or remove if quantity is 1
            if ($_SESSION['cart'][$remove_index]['quantity'] > 1) {
                $_SESSION['cart'][$remove_index]['quantity'] -= 1;
                $_SESSION['cart'][$remove_index]['total_price'] = $_SESSION['cart'][$remove_index]['quantity'] * $_SESSION['cart'][$remove_index]['price'];
            } else {
                unset($_SESSION['cart'][$remove_index]);
                $_SESSION['cart'] = array_values($_SESSION['cart']); // Reindex the array
            }
        }
    }

    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $index => $item) {
            echo '<div class="cart-item">';
            echo '<img src="' . $item['image'] . '" alt="' . $item['name'] . '">';
            echo '<div class="cart-item-info">';
            echo '<h4>' . $item['name'] . '</h4>';
            echo '<span>Quantity: ' . $item['quantity'] . '</span>';
            echo '</div>';
            echo '<div class="cart-item-price">$' . $item['total_price'] . '</div>';
            echo '<form action="" method="POST">';
            echo '<input type="hidden" name="remove" value="' . $index . '">';
            echo '<button type="submit" style="background-color: #f44336;">Remove</button>';
            echo '</form>';
            echo '</div>';
        }
    }
    ?>
</div>
</body>
</html>
