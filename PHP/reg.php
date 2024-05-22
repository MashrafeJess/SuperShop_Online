<?php
include "config.php";
if (isset($_POST['save'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
    $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
    $sql1 = "SELECT id FROM customers WHERE email = '{$email}'";
    $result1 = mysqli_query($conn, $sql1);
    if (mysqli_num_rows($result1) > 0) {
        $msg = "User already exists";
    } else if ($pass != $cpass) {
        $msg1 =  "Passwords didn't match";
    } else {
        $sql = "INSERT INTO customers (id,username,address,email,password) VALUES ('','{$username}','{$address}','{$email}','{$pass}')";
        $result = mysqli_query($conn, $sql) or die("error");
        header("Location:http://localhost/SSS/PHP/login.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap'>
    <link rel="stylesheet" href="../CSS/reg.css">

</head>

<body>
    <!-- partial:index.partial.html -->
    <div class="screen-1">
        <pre>


        </pre>
        <div class="email">
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                <label for="username">Username</label>
                <div class="sec-2">
                    <ion-icon name="mail-outline"></ion-icon>
                    <input type="text" name="username" placeholder="write your name" required />
                </div>
                <br>
                <label for="address">Address</label>
                <div class="sec-2">
                    <ion-icon name="mail-outline"></ion-icon>
                    <input type="text" name="address" placeholder="house/street/district" required />
                </div>
                <br>
                <label for="email">Email Address</label>
                <div class="sec-2">
                    <ion-icon name="mail-outline"></ion-icon>
                    <input type="email" name="email" placeholder="Username@gmail.com" required />
                </div>
        </div>
        <div class="password">
            <label for="password">Password</label>
            <div class="sec-2">
                <ion-icon name="lock-closed-outline"></ion-icon>
                <input class="pas" type="password" name="password" placeholder="············" required />
                <ion-icon class="show-hide" name="eye-outline"></ion-icon>
            </div>
            <label for="cpassword">Confirm Password</label>
            <div class="sec-2">
                <ion-icon name="lock-closed-outline"></ion-icon>
                <input class="pas" type="password" name="cpassword" placeholder="············" required />
                <ion-icon class="show-hide" name="eye-outline"></ion-icon>
            </div>
        </div>
        <button type="submit" class="login" name="save">Register </button>
        <div class="footer"><span><a class="arc" href="../PHP/login.php">Login</a></span><span><a class="arc" href="../PHP/mod.php">Forgot Password?</a></span></div>
        </form>
    </div>
    <!-- partial -->
    <div class="fot">
        <?php
        if (isset($msg)) {
            echo '<p class="err">' . $msg . '</p>';
        } else if (isset($msg1)) {
            echo '<p class = "err">' . $msg1 . '</p>';
        }
        ?>
    </div>

</body>

</html>