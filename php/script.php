<?php

class Script
{
    //GenerateList
    //  Display a list of registered users
    //  $db = active session
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

    //RedirectToLogin
    //  Redirect the user to the Login page
    //  $session = active session
    public static function RedirectToLogin($session){
        if(!$session->LoggedIn()) {
            $session->Redirect('index.php');
        }
    }

    //RedirectToHome
    //  Redirect the user to the Home page
    //  $session = active session
    public static function RedirectToHome($session){
        if($session->LoggedIn()) {
            $session->Redirect('home.php');
        }
    }
}