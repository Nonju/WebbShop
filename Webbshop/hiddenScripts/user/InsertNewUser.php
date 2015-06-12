<?php
/**
 * Created by PhpStorm.
 * User: hannesalbinsson
 * Date: 2015-03-17
 * Time: 08:33
 */

//Submit new userdata to users-table
include("../../hiddenScripts/DbLogin.php");
require("../../hiddenScripts/user/passwordCrypt.php");
if(isset($_POST['create-user-form']) && $_POST['createUsername'] !== 'Användarnamn'){
    $username = filter_input(INPUT_POST,'createUsername',FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST,'createPassword',FILTER_SANITIZE_SPECIAL_CHARS);
    $confirmPass = filter_input(INPUT_POST,'confirmPassword',FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST,'createEmail',FILTER_SANITIZE_SPECIAL_CHARS);

    //needs to turn 'true' in order to write to DB
    $unCheck = false;
    $pwCheck = false;
    $createUserEC; //errorCode
    //control USERNAME
    if(!preg_match('/\s/', $username)) { //checks if username contains space's
        $unCheck = true;
    }
    else {
        $createUserEC .= "unSpace ";
    }
    //control PASSWORD
    if(!preg_match('/\s/', $password) && !preg_match('/\s/', $confirmPass)) {
        if($password === $confirmPass) {
            $pwCheck = true;
        }
        else { //passwords didnt match
            echo "<script>alert('Lösenorden matchade inte!');</script>";
        }
    }
    else {
        $createUserEC .= "pwSpace ";
    }

    if($unCheck === true && $pwCheck === true) {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username,password,email,cart) VALUES ('{$username}','{$passwordHash}','{$email}',NULL);";
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $createUserEC .= $stmt->errorCode();
    }
}
