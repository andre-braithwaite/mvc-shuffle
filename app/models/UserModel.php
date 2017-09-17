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

        // Update due date
        foreach ($xml->children() as $user) {
            if ($user->username == $username) {
                $user->password = $newPass;
                self::saveXml($xml, $file);
            }
        }
        View::render('StudentPassSuccessView.php');

    }

}