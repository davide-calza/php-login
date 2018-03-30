<?php
session_start();
require_once("php/user.php");
require_once('php/script.php');
$user = new User();

/** If users are already logged in, they will be redirected to Home */
Script::RedirectToHome($user);

/** On registration button click */
if (isset($_POST['btn-signup'])) {
    $msg='';
    $name = $_POST['txt-name'];
    $email = $_POST['txt-email'];
    $password = $_POST['txt-password'];
    $retpwd = $_POST['txt-retpwd'];

    if(Script::RegisterUser($user, $name, $email, $password, $retpwd, $msg)){
        $success = $msg;
    }
    else{
        $error = $msg;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign up</title>
    <link rel="icon" href="cont/favicon.png">
    l<link rel="stylesheet" href="css/style.css" type="text/css"/>
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
    <script src="js/script.js" type="text/javascript"></script>
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

        <!--Registration form-->
        <form method="post" class="form-login">
            <h2 class="form-login-header">Sign Up</h2>
            <hr/>
            <?php
            if (isset($error)) {
                ?>
                <!--Error alert-->
                <div class="alert alert-danger">
                    <?php echo $error; ?>
                </div>
                <?php
            } else if (isset($_GET['joined'])) {
                ?>
                <!--Success alert-->
                <div class="alert alert-success">
                    Successfully registered! <a href="index.php" class="alert-link">Login here </a>
                </div>
                <?php
            }
            ?>
            <div class="form-group">
                <!--Username-->
                <input type="text" class="form-control" name="txt-name" placeholder="Enter Username"
                       value="<?php if (isset($error)) {
                           echo $name;
                       } ?>"/>
                <br />
                <!--Email-->
                <input type="text" class="form-control" name="txt-email" placeholder="Enter Email"
                       value="<?php if (isset($error)) {
                           echo $email;
                       } ?>"/>
                <br />
                <!--Password-->
                <input type="password" class="form-control" id="txt-password" name="txt-password" placeholder="Enter Password"/>
                <div class="clearfix"></div>
                <hr/>
                <!--Retype Password-->
                <input type="password" class="form-control" id="txt-retpwd" name="txt-retpwd" onkeyup="CheckNewPasswordRetype('txt-password', 'txt-retpwd')" placeholder="Retype Password"/>
                <div class="clearfix"></div>
                <hr/>
                <!--Submit button-->
                <button type="submit" class="btn btn-outline-info" name="btn-signup">Sign up</button>
            </div>
            <br/>
            <!--Sign in disclaimer-->
            <label>Already have an account? <a href="index.php">Sign in</a></label>
        </form>
    </div>
</div>
</body>
</html>
