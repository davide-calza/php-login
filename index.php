<?php
session_start();
require_once('user.php');
$login = new User();

//If the user is already logged in, it will be redirected to the home page
if ($login->LoggedIn()) {
    $login->redirect('home.php');
}

if (isset($_POST['btn-login'])) {
    $name = strip_tags($_POST['txt-name']);
    $email = strip_tags($_POST['txt-name']);
    $password = strip_tags($_POST['txt-password']);

    if ($login->Login($name, $email, $password)) {
        $login->Redirect('home.php');
    } else {
        $error = "Login failed";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>PHP Sucks</title>
        <link rel="stylesheet" href="css/style.css" type="text/css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="login-form">
            <div class="container">
                <div id="div-bp">
                    <button type="button" class="btn btn-outline-info btn-lg" id="btn-showbp" onclick="new function() {$('#btn-bp').show();}">Show PHP best practises</button>
                    <div class="alert alert-info" role="alert" id="btn-bp">1. Use something else :)</div>
                </div>
                <form class="form-login" method="post" id="login-form">
                    <h2 class="form-login-header">Login</h2>
                    <hr />
                    <div id="error">
                        <?php
                        if(isset($error)){
                            ?>
                            <div class="alert alert-danger">
                               <?php echo $error; ?>!
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="txt-name" placeholder="Username or Email" required />
                        <span id="check-e"></span>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="txt-password" placeholder="Password" />
                    </div>
                    <hr />
                    <div class="form-group">
                        <button type="submit" name="btn-login" class="btn btn-default">
                            Sign In
                        </button>
                    </div>
                    <br />
                    <label>Register now! <a href="register.php">Sign Up</a></label>
                </form>
            </div>
        </div>
    </body>
</html>
