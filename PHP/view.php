<?php
session_start();
if (!isset($_SESSION["ID"])) {
    header("Location: http://localhost/SSS/PHP/login.php");
    exit;
}
include "../PHP/config.php";
$ID = $_SESSION["ID"];

if (isset($_POST['save'])) {
    // Insert cart items into the database on form submission
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $product) {
            $id = $product['idd'];
            $name = $product['name'];
            $price = $product['price'];
            $quantity = $product['qty'];
            $total = $quantity * $price;

            $sql = "INSERT INTO details (Cid, pid, total) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "iid", $ID, $id, $total);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
            }
        }
    }
    // Clear the cart after saving to the database
    unset($_SESSION['cart']);
    header("Location: http://localhost/SSS/pictures/Home.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Cart</title>
    <link rel="stylesheet" href="../CSS/view.css">
</head>

<body>
    <div>
        <div class="head">
            <div class="a">
                <h1>CART :</h1>
            </div>
            <div class="box">
                <?php
                if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
                    echo '<div id="non">No Item added!!<br>The cart is empty.</div>';
                } else {
                    $totalPrice = 0;
                    echo '
                    <div id="con">ID</div> 
                    <div id="con">Name</div>
                    <div id="con">Price</div>
                    <div id="con">Quantity</div>
                    <div id="con">Total Price</div>';

                    foreach ($_SESSION['cart'] as $product) {
                        $id = $product['idd']; // Ensure this matches your session array key
                        $name = $product['name'];
                        $price = $product['price'];
                        $quantity = $product['qty'];
                        $subtotal = $price * $quantity;
                        $totalPrice += $subtotal;

                        echo '<div id="con">' . htmlspecialchars($id) . '</div>'; // Display ID
                        echo '<div id="con">' . htmlspecialchars($name) . '</div>';
                        echo '<div id="con">' . htmlspecialchars($price) . '</div>';
                        echo '<div id="con">' . htmlspecialchars($quantity) . '</div>';
                        echo '<div id="con">' . htmlspecialchars($subtotal) . '</div>';
                    }
                    echo '
                    <div></div>
                    <div></div>
                    <div></div>
                    <div id="con">Total : ' . htmlspecialchars($totalPrice) . '</div>';
                }
                ?>
            </div>
        </div>
    </div>
    <div>
        <form method="POST" action="view.php">
            <input class="foot" type="submit" name="save" value="Checkout">
        </form>
    </div>
</body>

</html>