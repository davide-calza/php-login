<?php

require_once("session.php");
require_once("php/user.php");
require_once("php/script.php");
$user = new User();
$id = $_SESSION['user-session'];

$query = $user->Query("SELECT * FROM user WHERE id=:id");
$query->execute(array(":id" => $id));
$row = $query->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Restricted area: <?php print($row['username']); ?></title>
    <link rel="icon" href="cont/favicon.png">
    <link rel="stylesheet" href="css/style.css" type="text/css"/>
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
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
            integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
            crossorigin="anonymous"></script>
    <script src="js/script.js" type="text/javascript"></script>
</head>

<body>
<!--Navbar-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" id="home-navbar">
    <!--Title-->
    <a class="navbar-brand" id="home-title" href="home.php">PHP Login</a>
    <!--Collapse buttons-->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <!--Home-->
            <li class="nav-item">
                <a class="nav-link" href="home.php">Home<span class="sr-only"></span></a>
            </li>
            <!--Restricted area-->
            <li class="nav-item active">
                <a class="nav-link" href="restricted.php">Restricted area<span class="sr-only">(current)</span></a>
            </li>
        </ul>
        <!--Right side buttons-->
        <form class="form-inline my-2 my-lg-0">
            <a class="btn btn-info my-2 my-sm-0" href="logout.php?logout=true">Logout</a>
        </form>
    </div>
</nav>
<!--Body-->
<div class="row" id="home-body-res">
    <div class="col-md-4">
        <div class="card text-left border-info">
            <div class="card-header bg-info text-white">Info</div>
            <div class="card-body">
                <h3 class="card-title"><?php print($row['username']); ?></h3>
                <p class="card-text"><?php print($row['email']); ?></p>
            </div>
            <div class="card-footer text-muted">joined on <?php print($row['joining']); ?></div>
        </div>
    </div>
    <div class="col-md-7" style="margin-left: 50px;">
        <div class="card text-left border-info">
            <div class="card-header bg-info text-white">README</div>
            <div class="card-body" id="readme">
                <h1 id="php-login">PHP Login</h1>
                <hr />
                <p>A simple, <strong>&quot;grandma-proof&quot;</strong> login system written in <strong>PHP</strong>. <br>Once registered and logged, you can add and delete other users, or modify their informations. <br>Password are encrypted with salty systems.</p>
                <br />
                <h2 id="prerequisites">Prerequisites</h2>
                <ul>
                    <li>MySQL</li>
                    <li>PHP </li>
                    <li>MySQL PDO extension </li>
                </ul>
                <br />
                <h2 id="to-manage-the-database">To manage the database</h2>
                <p>You can find the database dump in <strong>cont/php-login-db.sql</strong>  <br>Edit <strong>database.php</strong> before starting the server. </p>
                <p><em>Example:</em></p>
                <div id="readme-code">
                    <span class="decl">private</span> <span class="variable">$host</span> = <span class="string">&quot;localhost&quot;</span>; <br>
                    <span class="decl">private</span> <span class="variable">$database</span> = <span class="string">&quot;db_name&quot;</span>; <br>
                    <span class="decl">private</span> <span class="variable">$username</span> = <span class="string">&quot;mysql_user&quot;</span>; <br>
                    <span class="decl">private</span> <span class="variable">$password</span> = <span class="string">&quot;mysql_password&quot;</span>;
                </div>
                <br />
                <h4 id="technologies">Technologies</h4>
                <ul>
                    <li><a href="https://secure.php.net">PHP 7.2.3</a></li>
                    <li><a href="https://getbootstrap.com">Bootstrap 4.0.0</a> </li>
                    <li><a href="https://jquery.com">jQuery</a></li>
                    <li><a href="https://jqueryui.com">jQuery UI</a></li>
                    <li><a href="https://popper.js.org">Popper</a></li>
                </ul>
                <br />
                <h4 id="credits">Credits</h4>
                <ul>
                    <li><a href="https://www.flaticon.com/">Flaticon</a></li>
                </ul>
            </div>
            <div class="card-footer text-muted"><a href="https://github.com/davide-calza">Find me on Github!</a></div>
        </div>
    </div>
</div>
</body>
</html>
