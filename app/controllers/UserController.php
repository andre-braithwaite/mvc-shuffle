<?php

class UserController extends Controller {

    function mainMenu() {
        View::render('UserMainView.php');
    }

    function showDecks() {
        View::render('DecksMainView.php');
    }

    function changePass() {
        View::render('StudentPassView.php');
    }

    function importDeck() {
        View::render('ImportDeckView.php');
    }

    function importXml() {
        View::render('ImportingXmlView.php');
    }

    function importCsv() {
        View::render('ImportingCsvView.php');
    }

    static function saveXml($xml, $xmlName) {
        $outputFilename = (string)$xml;
        $dom = new DOMDocument('1.0');
        $dom->preserveWhiteSpace = false;
        $dom->formatOutput = true;
        $dom->loadXML($xml->asXML());
        $dom->save($xmlName);
    }

    function doDelete() {

        session_start();

        $deleteMe = $_SESSION['deleteMe'];

        $file = '../app/models/data/users.xml';
        $xml = LoginModel::xmlElement();

        // Delete from xml
        foreach ($xml->children() as $user) {
            if ($user->username == $deleteMe) {
                $dom=dom_import_simplexml($user);
                $dom->parentNode->removeChild($dom);
                self::saveXml($xml, $file);
            }
        }

        // Delete User Directory
        unlink('../app/models/data/' . $deleteMe . '/') or die("Couldn't delete file");


        View::render('DeleteUserView.php');
    }

}