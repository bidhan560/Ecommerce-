<?php
session_start();

if (isset($_POST['submit'])) {
    if (isset($_SESSION['product_counter'])) {
        $_SESSION['product_counter'] = $_SESSION['product_counter'] + 1;
    } else {
        $_SESSION['product_counter'] = 1;
        $_SESSION['cart'] = array();
    }

    if (isset($_POST['product_name']) && isset($_POST['product_price'])) {
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_image = '';

if ($product_name === 'Bottle') {
    $product_image = 'bottle.jpg';
} elseif ($product_name === 'LunchBox') {
    $product_image = 'lunch_box.jpg';
} elseif ($product_name === 'Mop') {
    $product_image = 'mop.jpg';
} elseif ($product_name === 'Bag') {
    $product_image = 'bag.jpg';
} elseif ($product_name === 'Scooter') {
    $product_image = 'scooter.jpg';
} elseif ($product_name === 'Laptop') {
    $product_image = 'laptop.jpg';
} elseif ($product_name === 'Apple') {
    $product_image = 'apple.jpg';
} elseif ($product_name === 'Orange') {
    $product_image = 'orange.jpg';
} elseif ($product_name === 'Banana') {
    $product_image = 'banana.jpg';
} elseif ($product_name === 'Romaine') {
    $product_image = 'romaine.jpg';
} elseif ($product_name === 'Peppers') {
    $product_image = 'peppers.jpg';
} elseif ($product_name === 'Basketball') {
    $product_image = 'basketball.jpg';
}
        // Check if the product is already in the cart
        $product_exists = false;
        foreach ($_SESSION['cart'] as $index => $item) {
            if ($item['name'] === $product_name && $item['image'] === $product_image) {
                $product_exists = true;
                $_SESSION['cart'][$index]['quantity'] += 1;
                $_SESSION['cart'][$index]['total_price'] = $_SESSION['cart'][$index]['quantity'] * $product_price;
                break;
            }
        }

        // If the product is not in the cart, add a new entry
        if (!$product_exists) {
            $_SESSION['cart'][] = array(
                'name' => $product_name,
                'price' => $product_price,
                'image' => $product_image,
                'quantity' => 1,
                'total_price' => $product_price,
            );
        }
    }
}

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

if (isset($_POST['destroy'])) {
    session_destroy();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<ul class="topnav">
    <li><a class="active" href="#home">Home</a></li>
    <li><a href="#news">Category</a></li>
    <li><a href="#contact">Discount</a></li>
    <li class="right"><a href="#about">Your Cart</a></li>
</ul>

<div class="card">
<form action="" method="POST">
        <h3>Apple</h3>
        <input type="hidden" name="product_name" value="Apple">
        <img src="apple.jpg" alt="apple">
        <input type="hidden" name="product_price" value="1">
        <h3>$1</h3>
        <button type="submit" name="submit">Add to Cart</button>
        <button type="submit" name="destroy">Reset</button>
    </form>

    <form action="" method="POST">
        <h3>Orange</h3>
        <input type="hidden" name="product_name" value="Orange">
        <img src="orange.jpg" alt="orange">
        <input type="hidden" name="product_price" value="1">
        <h3>$1</h3>
        <button type="submit" name="submit">Add to Cart</button>
        <button type="submit" name="destroy">Reset</button>
    </form>

    <form action="" method="POST">
        <h3>Bottle</h3>
        <input type="hidden" name="product_name" value="Bottle">
        <img src="bottle.jpg" alt="Bottle">
        <input type="hidden" name="product_price" value="5">
        <h3>$5</h3>
        <button type="submit" name="submit">Add to Cart</button>
        <button type="submit" name="destroy">Reset</button>
    </form>

    <form action="" method="POST">
        <h3>Lunch Box</h3>
        <input type="hidden" name="product_name" value="LunchBox">
        <img src="Lunch_Box.jpg" alt="LunchBox">
        <input type="hidden" name="product_price" value="9">
        <h3>$9</h3>
        <button type="submit" name="submit">Add to Cart</button>
        <button type="submit" name="destroy">Reset</button>
    </form>

    <form action="" method="POST">
        <h3>Mop</h3>
        <input type="hidden" name="product_name" value="Mop">
        <img src="mop.jpg" alt="mop">
        <input type="hidden" name="product_price" value="10">
        <h3>$10</h3>
        <button type="submit" name="submit">Add to Cart</button>
        <button type="submit" name="destroy">Reset</button>
    </form>

    <form action="" method="POST">
        <h3>Bag</h3>
        <input type="hidden" name="product_name" value="Bag">
        <img src="bag.jpg" alt="bag">
        <input type="hidden" name="product_price" value="10">
        <h3>$10</h3>
        <button type="submit" name="submit">Add to Cart</button>
        <button type="submit" name="destroy">Reset</button>
    </form>

    <form action="" method="POST">
        <h3>Scooter</h3>
        <input type="hidden" name="product_name" value="Scooter">
        <img src="scooter.jpg" alt="scooter">
        <input type="hidden" name="product_price" value="500">
        <h3>$500</h3>
        <button type="submit" name="submit">Add to Cart</button>
        <button type="submit" name="destroy">Reset</button>
    </form>

    <form action="" method="POST">
        <h3>Laptop</h3>
        <input type="hidden" name="product_name" value="Laptop">
        <img src="laptop.jpg" alt="laptop">
        <input type="hidden" name="product_price" value="500">
        <h3>$1500</h3>
        <button type="submit" name="submit">Add to Cart</button>
        <button type="submit" name="destroy">Reset</button>
    </form>

    <form action="" method="POST">
        <h3>Banana</h3>
        <input type="hidden" name="product_name" value="Banana">
        <img src="banana.jpg" alt="banana">
        <input type="hidden" name="product_price" value="1">
        <h3>$1</h3>
        <button type="submit" name="submit">Add to Cart</button>
        <button type="submit" name="destroy">Reset</button>
    </form>

    <form action="" method="POST">
        <h3>Romaine</h3>
        <input type="hidden" name="product_name" value="Romaine">
        <img src="romaine.jpg" alt="romaine">
        <input type="hidden" name="product_price" value="5">
        <h3>$5</h3>
        <button type="submit" name="submit">Add to Cart</button>
        <button type="submit" name="destroy">Reset</button>
    </form>
    

    <form action="" method="POST">
        <h3>Peppers</h3>
        <input type="hidden" name="product_name" value="Peppers">
        <img src="peppers.jpg" alt="peppers">
        <input type="hidden" name="product_price" value="5">
        <h3>$5</h3>
        <button type="submit" name="submit">Add to Cart</button>
        <button type="submit" name="destroy">Reset</button>
    </form>

    <form action="" method="POST">
        <h3>Basketball</h3>
        <input type="hidden" name="product_name" value="Basketball">
        <img src="basketball.jpg" alt="basketball">
        <input type="hidden" name="product_price" value="50">
        <h3>$50</h3>
        <button type="submit" name="submit">Add to Cart</button>
        <button type="submit" name="destroy">Reset</button>
    </form>
</div>



</body>
</html>
