<?php
/**
 * Created by PhpStorm.
 * User: hannesalbinsson
 * Date: 2015-02-03
 * Time: 09:57
 */

class articleObject {

    public $artNr;
    public $artName;
    public $artPrice;
    public $artDescription;
    public $nrInStore;

    public function __construct($artNr, $artName, $artPrice, $artDescription, $nrInStore) {
        $this->artNr = $artNr;
        $this->artName = $artName;
        $this->artPrice = $artPrice;
        $this->artDescription = $artDescription;
        $this->nrInStore = $nrInStore;
    }

    public function DrawOnScreen() { // make box bigger and find way to store IMG's
        echo "<div class='articleObject'>";
            echo "<img src='images/productIMGs/{$this->artName}{$this->artNr}.png' alt='{$this->artName}' class='artIMG'/>"; //echo "<img src='images/productIMGs/Dator1.png' alt='dator'/>";
            echo "<div class='nameAndPrice'>";
                echo "<a href='http://hannes.teknikprogrammet.org/Shop/?aNr={$this->artNr}' class='artLink'>{$this->artName}</a>";
                echo "<p class='artPrice'>{$this->artPrice}:-</p>";
            echo "</div>";
            echo "<div>";
                echo "<p class='artDescrip'>{$this->artDescription}</p>";

            echo "</div>";
            echo "<div class='lowerDiv'>";
                echo "<p>Antal i lager: {$this->nrInStore}</p>";
                echo "<a href='http://hannes.teknikprogrammet.org/Shop/?cartAdd={$this->artNr}' class='cartButton'>Lägg till i kundvagn</a>";
            echo "</div> \n\n";

            //echo "<p>{$this->linkToProductPage}</p>"; //used to test if link reached here
        echo "</div>";
    }
}