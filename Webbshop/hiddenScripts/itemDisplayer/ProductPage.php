<?php
/**
 * Created by PhpStorm.
 * User: hannesalbinsson
 * Date: 2015-03-10
 * Time: 23:21
 */

class ProductPage {

    public $artNr;
    public $artName;
    public $artPrice;
    public $artDescription;
    public $nrInStore;

    public function __construct($productInfoArray) {
        $this->artNr = $productInfoArray[0]['artNr'];
        $this->artName = $productInfoArray[0]['artName'];
        $this->artPrice = $productInfoArray[0]['price'];
        $this->artDescription = $productInfoArray[0]['description'];
        $this->nrInStore = $productInfoArray[0]['nrInStore'];
    }

    public function DrawOnScreen() {
        echo ("
            <div id='pPageSpace'>
                <img src='images/productIMGs/{$this->artName}{$this->artNr}.png' alt='{$this->artName}' id='ppIMG' />
                <div id='ppBuyInfo'>
                    <p id='ppName'>{$this->artName}</p>
                    <p id='ppPrice'>{$this->artPrice}</p>
                    <p id='ppArtNr'>{$this->artNr}</p>
                    <p id='ppNrInStore'>{$this->nrInStore}</p>
                    <a href='' >Lägg till i kundvagn</a>
                </div>
                <p id='ppDescription'>{$this->artDescription}</p>
            </div>
        ");

    }

} 