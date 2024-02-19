<?php
include("partials/_dbconnect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "select * from users where username='$username'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num == 1) {
        while ($row = mysqli_fetch_assoc($result)) {
            if (password_verify($password, $row['password'])) {
                $login = true;
                session_start();
                $_SESSION['username'] = $username;
                header("location:main/home.php");
            } else
                $invalid = true;
        }
    }else
    {
       $userNotFound=true;
    }
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../userAuth/style.css">
    <title>log in</title>
    <link rel="icon" type="image/x-icon/png" href="recipelogo.png">
</head>

<body>
    <div id="main-container" class="centered-flex">
        <div class="form-container">
            <div class="icon centered-flex"><i class="fa fa-user"></i></div>
            <div class="title">LOGIN</div>
            <form id="login-form" class="centered-flex" action="index.php" method="post">
                <div class="msg">
                    <?php
                    if ($invalid) {
                        echo 'Wrong password !';
                    }
                    if ($userNotFound) {
                        echo 'Please , first create an account';
                    }
                    ?>
                </div>
                <div class="field">
                    <input type="text" placeholder="Username" id="uname" name="username">
                    <i class="fa fa-user"></i>
                </div>
                <div class="field">
                    <input type="password" placeholder="Password" id="pass" name="password">
                    <i class="fa fa-lock"></i>
                </div>
                <div class="action centered-flex">
                    <label for="remember" class="centered-flex">
                        <input type="checkbox" id="remember"> Remember me
                    </label>
                    <a href="#">Forget Password ?</a>
                </div>
                <div class="btn-container"><button id="btn">Login</button></div>
                <div class="signup">Don't have an Account?<a href="../userAuth/signup.php"> Sign up</a></div>
            </form>
        </div>
    </div>
    <script src="../userAuth/login.js"></script>
</body>

</html>