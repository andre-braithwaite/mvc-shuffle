<?php

class LoginModel {

    static function testMethod() {
        return 'I am test data from the model';
    }

    static function databaseFound() {

        if(file_exists('../app/models/data/users.xml')){
            //echo 'User Database found';
            return true;
        } else {
            //echo 'User Database not found!';
            return false;
        }
    }

    static function xmlElement() {
        return new SimpleXMLElement('../app/models/data/users.xml', 0, true);
    }

    static function userFound($xml, $username) {

        $userExists = false;

        foreach ($xml->children() as $user) {
            if ($username == $user->username) {
                $userExists = true;
            }
        }

        if ($userExists) {
            return true;
        } else {
            return false;
        }
    }

    static function passCorrect($xml, $username, $password) {

        $goodPass = false;

        foreach ($xml->children() as $user) {
            if ($username == $user->username && $password == $user->password) {
                $goodPass = true;
            }
        }

        if ($goodPass) {
            return true;
        } else {
            return false;
        }
    }
}