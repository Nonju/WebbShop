<?php
    header("Content-Type: text/html; charset=utf-8");

    //start new userSession
    session_start();
    //checks if user is signing off
    $signOut = false;
    if(isset($_GET['signoff'])) {
        $signOut = filter_input(INPUT_GET,'signoff',FILTER_SANITIZE_SPECIAL_CHARS);
        if($signOut == 'true') {
            session_unset();
            echo "<script>
                //sends the user back to the startpage when signing off
                window.location = 'http://hannes.teknikprogrammet.org/Shop/';
            </script>";
        }
    }


    require("../../hiddenScripts/itemDisplayer/DisplayItems.php");
    $itemDisplayer = new DisplayItems();

    require("../../hiddenScripts/user/LoginUser.php");
    require("../../hiddenScripts/user/InsertNewUser.php");


?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <title>Webbshop</title>
  <link href="css/design.css" rel="stylesheet" /> <!-- .css stylesheet -->


</head>
<body>
<div id="wrappper"> <!-- for possible adjustments -->
    <div id="header" > <!-- collection of logoIMG, login and possible searchbar -->
        <img src="images/Logga.png" alt="loga" id="headerIMG" />

        <div id="headerSpace"> <!-- the space left on header after headerIMG -->
            <?php
            //displays a messagebox <div> with a message regarding the login/usercreation
            require("../../hiddenScripts/user/ErrorcodeDisplay.php");
            $ecDisp = new ErrorcodeDisplay();

            //decides what to show in the headerSpace
            if(isset($_SESSION['user_ID'])) {
                //shows customercart and ability to log off
                require("../../hiddenScripts/user/LoggedInHeaderSpace.php");
            }
            else {
                //displays the login/createUser-form
                require("visibleScripts/loginForm.html");
                //require("../../hiddenScripts/user/LoggedInHeaderSpace.php"); //test
            }
            $ecDisp->ShowErrorMsgs($createUserEC,$loginEC);

            //space for searching items
            require ("../../hiddenScripts/searchSpace.php");
            ?>
        </div>

        </div>
    </div>

    <div id="categoryMenu" >
        <nav class="catMenuNav">
            <a href="http://hannes.teknikprogrammet.org/Shop/" class="catMenuSec">Startsida</a>
            <a href="http://hannes.teknikprogrammet.org/Shop?category=computer" class="catMenuSec">Datorer</a>
            <a href="http://hannes.teknikprogrammet.org/Shop?category=gadget" class="catMenuSec">Tillbehör</a>
            <?php
                if(isset($_SESSION['user_ID'])){
                    echo "<a href='http://hannes.teknikprogrammet.org/Shop/?cartID={$user_ID}' class='catMenuSec'>Kundvagn</a>";
                }
            ?>
        </nav>
    </div>

    <div id="articleSpace" > <!-- loads in different articles depending on what's requested by user -->

        <?php //Php-function that generates articleObjects

        //Called when a category is selected
        $selectedCategory = 0;
        if(isset($_GET['category'])) {
            $selectedCategory = filter_input(INPUT_GET, 'category', FILTER_SANITIZE_SPECIAL_CHARS);
        }
        $selectedArticle = 0;
        if(isset($_GET['aNr'])) {
            $selectedArticle = filter_input(INPUT_GET, 'aNr', FILTER_SANITIZE_SPECIAL_CHARS);
        }

        if(isset($selectedCategory) && $selectedCategory !== 0) {
            $itemDisplayer->dispCat($selectedCategory);
        }
        else if(isset($selectedArticle) && $selectedArticle !== 0) {
            $itemDisplayer->dispSelect($selectedArticle);
        }
        else if(isset($_GET['cartID']) && isset($_SESSION['user_ID'])) {
            $itemDisplayer->dispCart();
        }
        else {
            $itemDisplayer->dispAll();
        }
        ?>
    </div>

<div class="clear"></div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="visibleScripts/design.js" type="text/javascript"></script> <!-- .js stylesheet that takes care of all other design details that .css cant do -->
</body>
</html>