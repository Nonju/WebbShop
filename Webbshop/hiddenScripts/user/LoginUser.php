<?php
/**
 * Created by PhpStorm.
 * User: hannesalbinsson
 * Date: 2015-03-18
 * Time: 16:54
 */


require("../../hiddenScripts/DbLogin.php");
require("../../hiddenScripts/user/passwordCrypt.php");
if(isset($_POST['submit-logon-form']) && $_POST['submitUsername'] !== 'Användarnamn') {
    $user_ID; //userID to be set if user's logged in
    $user_cart; //the users cart to be set if user's logged in
    $username = filter_input(INPUT_POST,'submitUsername',FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST,'submitPassword',FILTER_SANITIZE_SPECIAL_CHARS);


    //needs to turn 'true' in order to login
    $unCheck = false;
    $pwCheck = false;
    $loginEC; //errorcode

    //retrives usernames from DB, NOT optimal to retrive every user but works for now
    $sql = "SELECT * FROM users";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $dbArr = array();
    while($row = $stmt->fetch()) { //adds items to returned array
        array_push($dbArr, $row);
    }

    foreach($dbArr as $user) {
        if($username === $user['username']) {
            $unCheck = true;
            //break;
            if(password_verify($password,$user['password'])) {
                $pwCheck = true;
                //retrive the rest of the useful userdata
                $user_ID = $user['user_ID'];
                $user_cart = $user['cart'];
            }
        }
    }
    if($unCheck && $pwCheck) { //user is logged in
        $_SESSION['user_ID'] = $user_ID;
        $_SESSION['username'] = $username;
        $_SESSION['usercart'] = $user_cart;
    }
    else { //not logged in
        $loginEC .= 'loginFailed ';
    }
}
