<?php
session_start();
include "config.php";

if (!isset($_SESSION["ID"])) {
    header("Location:http://localhost/SSS/PHP/login.php");
    exit;
}

$id = $_SESSION["ID"];

// Fetch user details
$sql = "SELECT username, address, email FROM customers WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $name, $email, $address);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);

// Fetch product details
$product_sql = "
    SELECT p.name, p.price, p.company, d.total 
    FROM details d
    INNER JOIN products p ON d.pid = p.pid
    WHERE d.Cid = ?
";
$product_stmt = mysqli_prepare($conn, $product_sql);
mysqli_stmt_bind_param($product_stmt, "i", $id);
mysqli_stmt_execute($product_stmt);
mysqli_stmt_bind_result($product_stmt, $product_name, $product_price, $product_company, $product_total);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail View</title>
    <link rel="stylesheet" href="../CSS/detail.css">
</head>

<body>
    <div class="container">
        Username: <?php echo htmlspecialchars($name); ?><br>
        Email: <?php echo htmlspecialchars($email); ?><br>
        Address: <?php echo htmlspecialchars($address); ?><br>

    </div>
    <div class="head">
        <div class="o">
            Purchased Products:<br>
        </div>
        <div class="det">Product Name</div>
        <div class="det">Price</div>
        <div class="det">Company</div>
        <!-- <div class="det">Per Unit Price</div> -->
        <div class="det">Total Price</div>
        <?php

        while (mysqli_stmt_fetch($product_stmt)) {
            echo '
                <div class = "det" > ' . $product_name . ' </div><br>
                <div class = "det" > ' . $product_price . ' </div><br>
                <div class = "det" > ' . $product_company . ' </div><br>
                <div class = "det" > ' . $product_total . ' </div><br>';
        }

        ?>
    </div>
</body>

</html>
<?php
mysqli_stmt_close($product_stmt);
mysqli_close($conn);
?>