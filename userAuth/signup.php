<?php
$successalert = false;
$passalert = false;
$existUser = false;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include("../partials/_dbconnect.php");
    $username = $_POST['username'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $hpass = password_hash($password, PASSWORD_DEFAULT);
    
    $existsql = "SELECT * FROM `users` WHERE username='$username'";
    $result = mysqli_query($conn, $existsql);
    $numberOfUser = mysqli_num_rows($result);
    if ($numberOfUser > 0) {
        $existUser = "user is already exist";
    } else {
        if (($password == $cpassword)) {
            $sql = "INSERT INTO users (`username`, `password`) VALUES ('$username', '$hpass')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $successalert = true;
                header("location:..\index.php");
            }
        } else {
            $passalert = true;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Sign Up</title>
</head>

<body>
    <div id="main-container" class="centered-flex">
        <div class="form-container">
            <div class="icon centered-flex"><i class="fa fa-user"></i></div>
            <div class="title">SIGN UP</div>
            <form id="login-form" class="centered-flex"  action="signup.php" method="POST">
                <div class="msg">
                    <?php
                    if ($existUser) {
                        echo $existUser;
                    }
                    if ($successalert) {
                        echo "<p style='color: greenyellow '>Your account is created . Now you can login.</p>";
                    }

                    ?>
                </div>
                <div class="field">
                    <input type="text" placeholder="Username" id="uname" name="username" >
                    <i class="fa fa-user"></i>
                </div>
                <div class="field">
                    <input type="password" placeholder="Password" id="pass" name="password">
                    <i class="fa fa-lock"></i>
                </div>
                <div class="field">
                    <input type="password" placeholder="Confrom Password" id="cpass" name="cpassword">
                    <i class="fa fa-lock"></i>
                </div>
                <div class="action centered-flex">
                    <label for="remember" class="centered-flex">
                        <input type="checkbox" id="remember"> Remember me
                    </label>
                    <a href="#">Forget Password ?</a>
                </div>
                <div class="btn-container"><button id="btn">signup</button></div>
            </form>
        </div>
    </div>
    <script src="signup.js"></script>
</body>

</html>