<?php
/**
 * Created by PhpStorm.
 * User: hannesalbinsson
 * Date: 2015-02-03
 * Time: 09:13
 */

class DisplayItems {


    public function __construct() {

    }

    private function draw($itemArr) { //draws the wanted objects on the screen
        foreach($itemArr as $item) {
            $aO = new articleObject($item['artNr'], $item['artName'], $item['price'], $item['description'], $item['nrInStore']);
            //echo $item['productGroup'] . " ";
            $aO->DrawOnScreen();
        }
    }

    public function dispAll() { //displays all objects (or atleast a reasonable number of them)
        unset($itemArray); //clears array before adding new items
        require("../../hiddenScripts/DbReciever.php"); //has to be placed individually in every method that uses it
        require("../../hiddenScripts/itemDisplayer/articleObject.php");

        $dbReciver = new DbReciever();

        $itemArr = $dbReciver->DbReciver("SELECT * FROM products");

        $this->draw($itemArr); //draws the items on the screen

    }

    public function dispCat($selectedCategory) {
        unset($itemArray); //clears array before adding new items
        require("../../hiddenScripts/DbReciever.php"); //has to be placed individually in every method that uses it
        require("../../hiddenScripts/itemDisplayer/articleObject.php");

        $dbReciver = new DbReciever();
        //Retrive objects that belongs to selected category
        $itemArr = array();
        $tempArr = $dbReciver->DbReciver("SELECT * FROM products");
        foreach($tempArr as $item) {
            if($item['productGroup'] == $selectedCategory) {
                array_push($itemArr, $item);
            }
        };

        $this->draw($itemArr); //draws the items on the screen

    }

    public function dispSelect($artNr) { //will display selected item and retrive info about that item ONLY!!
        unset($itemArray); //clears array before adding new items
        require("../../hiddenScripts/DbReciever.php"); //has to be placed individually in every method that uses it
        require("../../hiddenScripts/itemDisplayer/ProductPage.php"); //displays the current selected product

        $dbReciver = new DbReciever();
        $itemArr = $dbReciver->DbReciver("SELECT * FROM products WHERE artNr = $artNr");
        $pp = new ProductPage($itemArr);
        $pp->DrawOnScreen();

        //$this->draw($itemArr); //draws the items on the screen

    }

    public function dispCart() {
        require("../../hiddenScripts/DbLogin.php");
        require("../../hiddenScripts/itemDisplayer/cartObject.php"); //displays the current products in the users cart

        //retrive current cartContent
        $cartID = filter_input(INPUT_GET,'cartID',FILTER_SANITIZE_SPECIAL_CHARS);
        $sql = "SELECT cart FROM users WHERE user_ID='$cartID'";
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        //echo $stmt->fetch()[0];
        $cartArr = explode("|",$stmt->fetch()[0]);

        foreach($cartArr as $product) {
            $sql = "SELECT * FROM products WHERE artName='$product'";
            $stmt = $dbh->prepare($sql);
            $stmt->execute();

            $product = $stmt->fetch();
            $cO = new cartObject($product);
            $cO->DrawOnScreen();
        }

    }

    //not in this version of the page
    public function dispSearch($search) { //use $search to retrive items from database that matches it's value
        unset($itemArray); //clears array before adding new items
        //unset($objectArray);
        require("../../hiddenScripts/DbReciever.php"); //has to be placed individually in every method that uses it

        $dbReciver = new DbReciever();

        $itemArr = 0; //add sql-question and such ($dbReciver->DbReviver($sql);
        if(isset($itemArr)) {
            $this->draw($itemArr); //draw the items on the screen
        }
        else {
            alert("Föremålet kunde inte hittas");
        }
    }


} 