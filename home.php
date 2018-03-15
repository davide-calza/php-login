<?php
require_once("session.php");
require_once("user.php");
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
    <title>Welcome <?php print($row['username']); ?></title>
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
</head>

<body>
<!--Navbar-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <!--Title-->
    <a class="navbar-brand" href="home.php">PHP Login</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <!--Collapse buttons-->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <!--Home-->
            <li class="nav-item active">
                <a class="nav-link" href="home.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <!--Profile-->
            <li class="nav-item">
                <a class="nav-link" href="profile.php">My profile</a>
            </li>
        </ul>
        <!--Right side buttons-->
        <form class="form-inline my-2 my-lg-0">
            <!--Search input-->
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <!--Search button-->
            <button class="btn btn-outline-info my-2 my-sm-0 mr-sm-2" type="submit">Search</button>
            <a class="btn btn-info my-2 my-sm-0" href="logout.php?logout=true">Logout</a>
        </form>
    </div>
</nav>
<!--Body-->
<div class="row" id="home-body">
    <!--Users list-->
    <div class="col-md-5">
        <div class="list-group" id="div-users-list">
            <?php
            $users = $user->Query('SELECT username, email, joining FROM user ORDER BY joining DESC');
            $users->execute();
            foreach ($users as $r){
                print('<a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">' .
                                    $r['username'] .
                                '</h5>
                                <small>joined on:' .
                                    $r['joining'] .
                                '</small>
                            </div>
                            <p class="mb-1">' .
                                $r['email'] .
                            '</p>
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-outline-info btn-lg my-2 my-sm-0 mr-sm-2" type="submit" style="height: 100%; width: 100%;">Modify</button>
                        </div>
                    </div>
                </a>');
            }
            ?>
        </div>
    </div>
    <div class="col-md-7">

    </div>
</div>
</body>
</html>
