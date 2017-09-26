<?php

class UserModel {

    static function saveXml($xml, $xmlName) {
        $outputFilename = (string)$xml;
        $dom = new DOMDocument('1.0');
        $dom->preserveWhiteSpace = false;
        $dom->formatOutput = true;
        $dom->loadXML($xml->asXML());
        $dom->save($xmlName);
    }

    static function setPass() {

        session_start();

        $username = $_SESSION['username'];
        $newPass = $_REQUEST['new-password'];

        $file = '../app/models/data/users.xml';
        $xml = LoginModel::xmlElement();

        // Update with new password
        foreach ($xml->children() as $user) {
            if ($user->username == $username) {
                $user->password = $newPass;
                self::saveXml($xml, $file);
            }
        }
        View::render('StudentPassSuccessView.php');

    }

    static function addUser() {

        session_start();

        $username = $_REQUEST['username'];
        $password = $_REQUEST['password'];

        $file = '../app/models/data/users.xml';
        $xml = LoginModel::xmlElement();


        // Make new user if they don't already exist
        if ((LoginModel::userFound($xml, $username)) == false) {

            $addedUser = $xml->addChild('user');
            $addedUser->addChild(username, $username);
            $addedUser->addChild(password, $password);

            // Make User directory
            mkdir('../app/models/data/' . $username, 0700);

            // Add user to xml file
            $dom = new DOMDocument('1.0');
            $dom->preserveWhiteSpace = false;
            $dom->formatOutput = true;
            $dom->loadXML($xml->asXML());
            $dom->save($file);

            View::render('NewUserSuccessView.php');

        } else {
            echo("<script>window.location = '../login-controller/new-user';</script>");
        }
    }



    static function adminPass() {

        $newPass = $_REQUEST['new-password'];
        $adminPassFile = '../app/models/data/admin_pass.xml';

        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><password></password>');

        $xml->addChild('value');
        $xml->value = $newPass;

        // Add user to xml file
        $dom = new DOMDocument('1.0');
        $dom->preserveWhiteSpace = false;
        $dom->formatOutput = true;
        $dom->loadXML($xml->asXML());
        $dom->save($adminPassFile);

        View::render('AdminPassSuccessView.php');


    }

    static function getUsers($usersDir)
    {

        $users = array();


        foreach(glob($usersDir . '*', GLOB_ONLYDIR) as $dir) {
            $dirname = basename($dir);
            array_push($users, $dirname);
        }



        return $users;
    }

}