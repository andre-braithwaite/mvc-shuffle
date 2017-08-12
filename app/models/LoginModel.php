<?php

class LoginModel {

    static function testMethod() {
        return 'I am test data from the model';
    }

    static function databaseFound() {

        if(file_exists('../app/models/data/users.xml')){
            echo 'User Database found';
            return true;
        } else {
            echo 'User Database not found!';
            return false;
        }
    }

}