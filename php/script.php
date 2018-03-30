<?php

/**
 * Class Script
 * Manage generic php scripts
 */
class Script
{

    /**GenerateList
     *
     * Display a list of registered users
     * @param $db   = active session
     * @param $name = name of the session user
     */
    public static function GenerateList($db, $name){
        $users = $db->Query('SELECT username, email, joining FROM user ORDER BY joining DESC');
        $users->execute();
        foreach ($users as $r){
            if($r['username'] == $name){
                $list_name = '<h5 class="mb-1"><strong>' . $r['username'] . '</strong></h5>';
                $ind = '<span class="badge badge-info badge-pill" id="badge-'.$name.'">You</span>';
            }
            else{
                $list_name = '<h5 class="mb-1">' . $r['username'] . '</h5>';
                $ind = '';
            }
            print('<a href="#" id="item-' . $r['username'] .'" class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="d-flex w-100 justify-content-between">'.
                                $list_name  .'
                                <small>joined on:' . $r['joining'] . '</small>
                            </div>
                            <p class="mb-1">' . $r['email'] . '</p> '. $ind .'
                        </div>
                        <div class="col-md-3">
                            <button id="btn-' . $r['username'] .'" class="btn btn-lg my-2 my-sm-0 mr-sm-2 btn-outline-info" type="submit" style="height: 100%; width: 100%;" onclick="ModifyUser(\'' . $r['username'] . '\', \'' . $r['email'] . '\', \'div-modify-user\')">Modify</button>
                        </div>
                    </div>
                </a>');
        }
    }

    /**RedirectToLogin
     *
     * Redirect the user to the Login page
     * @param $session = active session
     */
    public static function RedirectToLogin($session){
        if(!$session->LoggedIn()) {
            $session->Redirect('index.php');
        }
    }

    /**RedirectToHome
     *
     * Redirect the user to the Home page
     * @param $session = active session
     */
    public static function RedirectToHome($session){
        if($session->LoggedIn()) {
            $session->Redirect('home.php');
        }
    }

    /**Login
     *
     * Check if login is possible and execute it
     * @param $session  = active session
     * @param $name     = name of the user
     * @param $email    = email of the user
     * @param $password = password of the session user
     * @param $msg      = output message (success|failure)
     * @return bool     = true if successful
     */
    public static function LoginUser($session, $name, $email, $password, &$msg){
        if ($session->Login($name, $email, $password)) {
            $session->Redirect('home.php');
            return true;
        } else {
            $msg = "Invalid credentials";
        }
        return false;
    }

    /**UpdateUser
     *
     * Check if update is possible and execute it
     * @param $session  = active session
     * @param $oldname  = old name of the user
     * @param $oldmail  = old mail of the user
     * @param $ownpwd   = password of session user
     * @param $name     = new name of the user
     * @param $email    = new email of the user
     * @param $password = new password of the user
     * @param $retpwd   = retyped password
     * @param $msg      = output message (success|failure)
     * @return bool     = true if successful
     * @param $retpwd   = retyped password
     */
    public static function UpdateUser($session, $oldname, $oldmail, $ownpwd, $name, $email, $password, $retpwd, &$msg){
        if($password <> $retpwd){
            $msg = "Passwords not coincident!";
        }
        else if ($session->Update($oldname, $oldmail, $ownpwd, $name, $email, $password)){
            $msg = "User successfully updated";
            return true;
        }
        else{
            $msg = "Incorrect password!";
        }
        return false;
    }

    /**DeleteUser
     *
     * Check if unregistration is possible and execute it
     * @param $session  = active session
     * @param $name     = name of the user
     * @param $email    = email of the user
     * @param $password = password of the session user
     * @param $msg      = output message (success|failure)
     * @return bool     = true if successful
     */
    public static function DeleteUser($session, $name, $email, $password, &$msg){
        if ($session->Unregister($name, $email, $password)){
            $msg = "User successfully deleted";
            return true;
        }
        else{
            $msg = "Incorrect password!";
        }
        return false;
    }
}