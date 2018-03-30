<?php
session_start();
require_once('php/user.php');
require_once('php/script.php');
$user = new User();

/** If the user is already logged in, it will be redirected to the home page  */
Script::RedirectToHome($user);

/** On login button click */
if (isset($_POST['btn-login'])) {
    $msg = '';
    $name = strip_tags($_POST['txt-name']);
    $email = strip_tags($_POST['txt-name']);
    $password = strip_tags($_POST['txt-password']);

    if(!Script::LoginUser($user, $name, $email, $password, $msg)){
        $error = "Invalid credentials";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign in</title>
    <link rel="stylesheet" href="css/style.css" type="text/css"/>
    <link rel="icon" href="cont/favicon.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.js"
            integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>
</head>
<body>
<div class="login-form">
    <div class="container">
        <!--PHP Best Practices :)-->
        <div id="div-bp">
            <button type="button" class="btn btn-outline-info btn-lg" id="btn-showbp"
                    onclick="new function() {$('#btn-bp').show();}">Show PHP best practices
            </button>
            <div class="alert alert-info" role="alert" id="btn-bp">1. Use something else :)</div>
        </div>
        <!--Login form-->
        <form class="form-login" method="post" id="login-form">
            <h2 class="form-login-header">Sign In</h2>
            <hr/>
            <!--Error alert-->
            <div id="error">
                <?php
                if (isset($error)) {
                    ?>
                    <div class="alert alert-danger">
                        <?php echo $error; ?>! <a href="register.php" class="alert-link">Sign up</a> now
                    </div>
                    <?php
                }
                ?>
            </div>
            <div class="form-group">
                <!--Username or Email-->
                <input type="text" class="form-control" name="txt-name" placeholder="Enter Username or Email" required/>
                <span id="check-e"></span>
                <br/>
                <!--Password-->
                <input type="password" class="form-control" name="txt-password" placeholder="Enter Password"/>
                <hr/>
                <!--Submit button-->
                <button type="submit" name="btn-login" class="btn btn-outline-info">Sign in</button>
            </div>
            <br/>
            <!--Registration disclaimer-->
            <label>Not registered yet? <a href="register.php">Sign up now!</a></label>
        </form>
    </div>
</div>
</body>
</html>
