<?php
/**
 * Created by PhpStorm.
 * User: hannesalbinsson
 * Date: 2015-02-12
 * Time: 18:11
 */

class DbReciever {


    /* not really needed (not now atleast) */
    public function __construct() { //removed "$sqlQuestion"

    }
    /**/
    public function DbReciver($sql) {
        include("DbLogin.php"); //login-information to database
        //include("../../hiddenScripts/DbLogin.php");

            $stmt = $dbh->prepare($sql);
            $stmt->execute();

            $dbArr = array();
            while($row = $stmt->fetch()) { //adds items to returned array
                array_push($dbArr, $row);
            }

        return $dbArr;
    }
} 