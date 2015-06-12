<?php
/**
 * Created by PhpStorm.
 * User: hannesalbinsson
 * Date: 2015-03-19
 * Time: 20:47
 */

class cartObject {

    public $artNr;
    public $artName;
    public $artPrice;

    public function __construct($objectArr) {
        $this->artNr = $objectArr['artNr'];
        $this->artName = $objectArr['artName'];
        $this->artPrice = $objectArr['price'];
    }

    public function DrawOnScreen() {
        echo ("
            <div id='cartItem'>
                <img src='images/productIMGs/{$this->artName}{$this->artNr}.png' alt='{$this->artName}' />
                <div id='cartItemInfo'>
                    <p>{$this->artName}</p>
                    <p>{$this->artPrice}</p>
                </div>
            </div>
        ");
    }



} 