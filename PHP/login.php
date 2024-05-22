<?php
include "config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save'])) {
    // Sanitize and hash the inputs
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

    $sql = "SELECT id FROM customers WHERE email = '{$email}' AND password = '{$pass}'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        session_start();
        $row = mysqli_fetch_assoc($result);
        $_SESSION["ID"] = $row['id'];
        header("Location: http://localhost/SSS/pictures/Home.php");
        exit();
    } else {
        $error_message = "Invalid email or password.";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>CodePen - Finance Mobile Application-UX/UI Design Screen One</title>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap'>
    <link rel="stylesheet" href="../CSS/login.css">

</head>

<body>
    <!-- partial:index.partial.html -->
    <div class="screen-1">
        <pre>


        </pre>
        <div class="email">
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                <label for="email">Email Address</label>
                <div class="sec-2">
                    <ion-icon name="mail-outline"></ion-icon>
                    <input type="email" name="email" placeholder="Username@gmail.com" />
                </div>
        </div>
        <div class="password">
            <label for="password">Password</label>
            <div class="sec-2">
                <ion-icon name="lock-closed-outline"></ion-icon>
                <input class="pas" type="password" name="password" placeholder="············" />
                <ion-icon class="show-hide" name="eye-outline"></ion-icon>
            </div>
        </div>
        <button type="submit" class="login" name="save">Login </button>
        <div class="footer"><span><a class="of" href="../PHP/reg.php">Signup</a></span><span><a class="of" href="../PHP/mod.php">Forgot Password?</a></span></div>
        </form>
    </div>
    <!-- partial -->

</body>

</html>