<?php
session_start();

if (isset($_POST['save'])) {

    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $quant = $_POST['qty'];

    // Initialize the cart array if it doesn't exist
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // Create a cart item array
    $cartItem = array(
        'idd' => $id,
        'name' => $name,
        'price' => $price,
        'qty' => $quant
    );

    // Add the cart item to the session cart
    $_SESSION['cart'][] = $cartItem;

    // Set a success message
    $_SESSION['success'] = 'Item Added Successfully';

    // Redirect back to the previous page to avoid form resubmission
    header('Location: http://localhost/SSS/pictures/Home.php');
    exit;
}

// Debug output (if needed)
// echo '<pre>' . print_r($_SESSION, true) . '</pre>';
