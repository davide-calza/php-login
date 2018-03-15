<?php

class Scripts
{
    public static function GenerateList($db){
        $users = $db->Query('SELECT username, email, joining FROM user ORDER BY joining DESC');
        $users->execute();
        foreach ($users as $r){
            print('<a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">' . $r['username'] . '</h5>
                                <small>joined on:' . $r['joining'] . '</small>
                            </div>
                            <p class="mb-1">' . $r['email'] . '</p>
                        </div>
                        <div class="col-md-3">
                            <button id="btn-' . $r['username'] .'"  class="btn btn-outline-info btn-lg my-2 my-sm-0 mr-sm-2" type="submit" style="height: 100%; width: 100%;">Modify</button>
                        </div>
                    </div>
                </a>');
        }
    }
}