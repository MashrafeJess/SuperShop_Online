<?php
include "../PHP/config.php";
session_start();
session_unset();
session_destroy();
$sql = "SELECT pid,name,price,company,pictures FROM products ";
$result = mysqli_query($conn, $sql) or die("error");
?>
<html>

<head>
    <link rel="stylesheet" href="../CSS/dash.css">
</head>

<body>
    <div class="container">
        <div class="a"><a class="lol" href="../PHP/login.php">Login</a> </div>
        <div class="a"> <a class="lol" href="../PHP/reg.php">registration</a></div>
        <div class="a"> <a class="lol" href="../PHP/view.php">View Cart</a> </div>
    </div>
    </div>
    <div class="head">
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            $ID = $row['pid'];
            $name = $row['name'];
            $price = $row['price'];
            $comp = $row['company'];
            $pic = $row['pictures'];

            echo '
            <div class="b"> 
            <img  src="' . $pic . '" width="150px" height="150px"><br>
            
            Name: ' . $name . '<br>
            Price: ' . $price . 'tk<br>
            Company: ' . $comp . '<br>
            <form method="POST" action="">
                <input class="inp" type="number" name="qty" placeholder="Quantity" required>
                <input type="hidden" name="name" value="' . $name . '">
                <input type="hidden" name="price" value="' . $price . '">
                <input type="hidden" name="id" value="' . $ID . '">
                <button type="submit" name="save">
                    <img class="bt" src="../pictures/cart.png" alt="Add to Cart" width="15px" height="15px">
                </button>
            </form>

            </div>';
        }
        ?>
    </div>

</body>

</html>