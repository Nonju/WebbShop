<?php
/**
 * Created by PhpStorm.
 * User: hannesalbinsson
 * Date: 2015-03-18
 * Time: 21:58
 */
include("../../hiddenScripts/DbLogin.php");
$un = $_SESSION['username'];
if(isset($_GET['cartAdd']) && isset($_SESSION['user_ID'])) {
    //find out what item is added
    $itemToAdd = filter_input(INPUT_GET,'cartAdd',FILTER_SANITIZE_SPECIAL_CHARS);
    $sql = "SELECT artName FROM products WHERE artNr='$itemToAdd'";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $itemToAdd = $stmt->fetch()[0];

    //retrive current cart-string
    $sql = "SELECT cart FROM users WHERE username='$un'";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $cartString = $stmt->fetch()[0]; //fetch cartContent

    //update cart-string
    $newCartString = $cartString . '|' . $itemToAdd; //add new product + a divider
    $sql = "UPDATE users SET cart='$newCartString' WHERE username='$un'";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();

    //removing the cartAdd "command" from the URL
    if(isset($_GET['aNr'])) {
        $aNr = filter_input(INPUT_GET,'aNr',FILTER_SANITIZE_SPECIAL_CHARS);
        echo "<script> //return
            window.location = 'http://hannes.teknikprogrammet.org/Shop/?aNr={$aNr}';
        </script>";
    }
    else {
        echo "<script> //return
            window.location = 'http://hannes.teknikprogrammet.org/Shop/';
        </script>";
    }

}

/*
if(isset($_GET['cartID']) && isset($_SESSION['user_ID'])) {
    //retrive current cartContent
    $cartID = filter_input(INPUT_GET,'cartID',FILTER_SANITIZE_SPECIAL_CHARS);
    $sql = "SELECT cart WHERE user_ID='$cartID'";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $cartArr = array();

    while($row = $stmt->fetch()) {
        array_push($cartArr, $row);
    }


    //lägg till "window.location" här
}*/

?>
<div id="loggedinSpace">
    <?php
    $user_ID = $_SESSION['user_ID'];
    $username = $_SESSION['username'];
        echo "<p id='loggedinUser'>Inloggad som: {$username}</p>";
        echo "<a href='http://hannes.teknikprogrammet.org/Shop/?signoff=true' id='signoffBtn'>Logga ut</a>";
    ?>
</div>