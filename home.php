<?php
require_once("session.php");
require_once("php/user.php");
require_once("php/script.php");
$user = new User();
$id = $_SESSION['user-session'];

$query = $user->Query("SELECT * FROM user WHERE id=:id");
$query->execute(array(":id" => $id));
$row = $query->fetch(PDO::FETCH_ASSOC);

/** On update button click  */
if (isset($_POST['btn-update'])){
    $msg='';
    $oldname = explode('_',$_POST['btn-update'])[0];
    $oldmail = explode('_',$_POST['btn-update'])[1];
    $name = $_POST['txt-username'];
    $email = $_POST['txt-email'];
    $password = $_POST['txt-newpwd'];
    $retpwd = $_POST['txt-retpwd'];
    $ownpwd = strip_tags($_POST['txt-pwd']);
    if(Script::UpdateUser($user, $oldname, $oldmail, $ownpwd, $name, $email, $password, $retpwd, $msg)){
        $success = $msg;
    }
    else{
        $error = 'mod_'.$msg;
    }
}

/** On delete button click  */
if (isset($_POST['btn-delete'])){
    $msg='';
    $name = explode('_',$_POST['btn-delete'])[0];
    $email = explode('_',$_POST['btn-delete'])[1];
    $password = strip_tags($_POST['txt-pwd']);
    if(Script::DeleteUser($user, $name, $email, $password,$msg)){
        $success = $msg;
    }
    else{
        $error = 'mod_'.$msg;
    }
}

/** On add button click  */
if (isset($_POST['btn-add'])){
    $msg='';
    $name = $_POST['txt-username'];
    $email = $_POST['txt-email'];
    $password = $_POST['txt-newpwd'];
    $retpwd = $_POST['txt-retpwd'];
    $ownpwd = strip_tags($_POST['txt-pwd']);
    if(Script::AddUser($user, $name, $email, $password, $retpwd, $ownpwd, $msg)){
        $success = $msg;
    }
    else{
        $error = 'add_'.$msg;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome, <?php print($row['username']); ?>!</title>
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
            <li class="nav-item active">
                <a class="nav-link" href="home.php">Home <span class="sr-only">(current)</span></a>
            </li>
        </ul>
        <!--Right side buttons-->
        <form class="form-inline my-2 my-lg-0">
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
            if(isset($success)){
                ?>
                <!--Success alert-->
                <div class="alert alert-success alert-dismissible" id="alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Success!</strong> <?php echo $success ?>
                </div>
                <script>$('#alert-success').show('slide', { direction: 'up' }, 200);</script>
            <?php
                unset($success);
            }
            Script::GenerateList($user, $row['username']);
            ?>
            <button type="button" class="btn btn-info btn-lg" id="btn-adduser" onclick="AddUser('div-modify-user', false)">+</button>
        </div>
    </div>
    <!--Modify user form-->
    <div class="col-md-7" id="div-modify-user"></div>
</div>

<script>
    <?php
    /** On Error */
    if(isset($error)){
        $type = explode('_', $error)[0];
        $err_msg = explode('_', $error)[1];
        if($type == 'mod'){
    ?>
            ModifyUser(<?php echo '"' . $name . '","' . $email . '","div-modify-user", true'; ?>);
    <?php
        }
        else{
            ?>
            AddUser("div-modify-user", true);
    <?php
        }
    ?>
    ErrorAlert('form-modify-user', '<?php echo $err_msg ?>', 'txt-pwd');
    <?php
    unset($error);
    }
    ?>
</script>

</body>
</html>
