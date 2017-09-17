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

        // Delete from xml

        $file = '../app/models/data/users.xml';
        $xml = LoginModel::xmlElement();

        foreach ($xml->children() as $user) {
            if ($user->username == $deleteMe) {
                $dom=dom_import_simplexml($user);
                $dom->parentNode->removeChild($dom);
                self::saveXml($xml, $file);
            }
        }


        // Delete User Directory
        function deleteUserDirectory($target) {
            if(is_dir($target)) {
                $files = glob( $target . '*', GLOB_MARK );
                foreach( $files as $file )
                {
                    deleteUserDirectory( $file );
                }

                @rmdir( $target );
                echo '<body style=\'background-color:#3b5998;\'></body>';

            } elseif(is_file($target)) {
                unlink( $target );
            }
        }

        $deleteThis = '../app/models/data/' . $deleteMe;
        deleteUserDirectory($deleteThis);





        // Keep blue background when processing login
        echo '<body style=\'background-color:#3b5998;\'></body>';
        echo "<script>window.location='../login-controller/delete-user'</script>";
    }

}