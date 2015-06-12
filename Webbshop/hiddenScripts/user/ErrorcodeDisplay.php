<?php
/**
 * Created by PhpStorm.
 * User: hannesalbinsson
 * Date: 2015-03-18
 * Time: 13:27
 */

class ErrorcodeDisplay {


    public function __construct() { }


    public function ShowErrorMsgs($createUserEC,$loginEC) {
        $codeString = $createUserEC . $loginEC;
        $eCodes = $this->DetectMsgs($codeString);

        foreach($eCodes as $eCode) {
            $eCode = $this->changeToNr($eCode); //errorcodes with letters didn't work so remaking them into numerical codes
            switch($eCode) {
                case '00000': //user created
                    echo "<script>
                        document.getElementById('formMessageBox').style.display = 'block';
                        document.getElementById('fmbText').innerHTML += '<br />En ny användare är skapad!! <br /> Prova logga in!';
                    </script>";
                    break;
                case '23000': //a user with that username already exists
                    echo "<script>
                        document.getElementById('formMessageBox').style.display = 'block';
                        document.getElementById('fmbText').innerHTML += '<br />Det fanns redan en användare med det namnet. Välj ett annat!';
                    </script>";
                    break;
                case '0001': //space within username
                    echo "<script>
                        document.getElementById('formMessageBox').style.display = 'block';
                        document.getElementById('fmbText').innerHTML += '<br />Använd inte mellanrum i användarnamnet';
                    </script>";
                    break;
                case '0002': //spaces within password
                    echo "<script>
                        document.getElementById('formMessageBox').style.display = 'block';
                        document.getElementById('fmbText').innerHTML += '<br />Använd inte mellanrum i lösenordet';
                    </script>";
                    break;
                case '0003': //login failed
                    echo "<script>
                        document.getElementById('formMessageBox').style.display = 'block';
                        document.getElementById('fmbText').innerHTML += '<br />Användarnamnet stämde inte överens med lösenordet '
                    </script>";
                    break;
                default:
                    echo "<script>
                        document.getElementById('formMessageBox').style.display = 'none';
                    </script>";
                    break;
            }
        }
    } //end function

    private function DetectMsgs($codeString) { //divides $codeString into an array with different messageCodes
        $codes = explode(" ", $codeString);
        return $codes;
    }

    private function changeToNr($code) { //remakes the errorcodes into numerical codes
        if($code == 'unSpace') {$code = '0001';}
        else if($code == 'pwSpace') {$code = '0002';}
        else if($code == 'loginFailed') {$code = '0003';}

        return $code;
    }

}
