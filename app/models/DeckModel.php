<?php

class DeckModel
{

    static function deckFolder()
    {
        return '../app/models/data/';
    }


    static function getField($deck, $rank, $field)
    {

        $xml = new SimpleXMLElement($deck, 0, true);

        foreach ($xml->children() as $card) {
            if ($rank == $card->rank) {
                return (string)$card->$field;
            }
        }
    }


    static function getDecks($decksDir)
    {

        $decks = array();

        if ($decksDir) {
            while (($deck = readdir($decksDir)) != false) {
                if ($deck != '.' && $deck != '..' && $deck != '.htaccess') {

                    array_push($decks, $deck);
                }
            }
            closedir($decksDir);
        }
        return $decks;
    }

    // Return the number of new cards in the deck
    static function numNew($xmlName)
    {

        $xml = new SimpleXMLElement($xmlName, 0, true);
        $totalCards = 0;

        foreach ($xml->children() as $card) {
            if ($card->new == "true") {
                $totalCards += 1;
            }
        }
        return $totalCards;
    }

    // Return the number of cards to review today
    static function numReview($xmlName)
    {
        // Set the timezone
        date_default_timezone_set('Europe/London');

        $xml = new SimpleXMLElement($xmlName, 0, true);
        $totalCards = 0;

        foreach ($xml->children() as $card) {
            if ($card->due <= self::getTodaysDate()) {
                $totalCards += 1;
            }
        }
        return $totalCards;
    }

    static function newToTest($deckXML)
    {
        $newAvailable = DeckModel::numNew($deckXML);

        if ($newAvailable > 5) {
            return 5;
        } else {
            return $newAvailable;
        }
    }

    // Save xml file
    static function saveXml($xml, $xmlName)
    {
        $outputFilename = (string)$xml;
        $dom = new DOMDocument('1.0');
        $dom->preserveWhiteSpace = false;
        $dom->formatOutput = true;
        $dom->loadXML($xml->asXML());
        $dom->save($xmlName);
    }


    // Returns rank of first card marked as new and
    static function getNewCard($xmlName)
    {

        $xml = new SimpleXMLElement($xmlName, 0, true);

        if ($_SESSION['newToTest'] > 0) {

            foreach ($xml->children() as $card) {
                if ($card->new == "true") {
                    $card->new = "false";
                    // save changing card to false
                    self::saveXml($xml, $xmlName);
                    return (string)$card->rank;
                }
            }
        }
    }

    // Returns rank of first card marked for review today
    static function getReviewCard($xmlName) {

        $xml = new SimpleXMLElement($xmlName, 0, true);

        foreach ($xml->children() as $card) {
            if ($card->due <= self::getTodaysDate()) {
                return (string)$card->rank;
            }
        }
    }

    static function speedGrade($seconds)
    {
        if ($seconds > 6) {
            return 5;
        } elseif ($seconds > 3) {
            return 4;
        } else {
            return 3;
        }
    }

    static function newE($deck, $rank, $grade) {

        $oldE = self::getField($deck, $rank, 'eFactor');
        $newVal = $oldE + (0.1 - (5 - $grade)) * (0.08 + (5 - $grade) * 0.02);

        if ($newVal < 1.3) {
            $newVal = 1.3;
        }

        $xml = new SimpleXMLElement($deck, 0, true);

        foreach ($xml->children() as $card) {
            if ($card->rank == $rank) {
                $card->eFactor = $newVal;
                self::saveXml($xml, $deck);
            }
        }
    }


    function getTodaysDate () {
        return date('Y-m-d');
    }


    // Returns date n days after today
    function addDays ($days) {
        return date('Y-m-d', strtotime("+" . $days . " days"));
    }

    static function newDate($deck, $rank) {

        // Set the timezone
        date_default_timezone_set('Europe/London');
        $repNum = self::getField($deck, $rank, 'repNum');
        $eFactor = self::getField($deck, $rank, 'eFactor');

        // Calculate the interval
        if ($repNum == 1) {
            $interval = 1;
        } elseif ($repNum == 2) {
            $interval = 2;
        } else {
            $interval = ($repNum - 1) * $eFactor;
        }

        // Add interval to current date
        $newDate = self::addDays($interval);

        $xml = new SimpleXMLElement($deck, 0, true);

        // Update due date
        foreach ($xml->children() as $card) {
            if ($card->rank == $rank) {
                $card->due = $newDate;
                self::saveXml($xml, $deck);
            }
        }

        // Update the repetition number
        foreach ($xml->children() as $card) {
            if ($card->rank == $rank) {
                $card->repNum = $repNum + 1;
                self::saveXml($xml, $deck);
            }
        }
    }


    static function againToday($deck, $rank) {

        // Set the timezone
        date_default_timezone_set('Europe/London');

        $repNum = self::getField($deck, $rank, 'repNum');
        $newDate = self::getTodaysDate();

        $xml = new SimpleXMLElement($deck, 0, true);

        // Update due date
        foreach ($xml->children() as $card) {
            if ($card->rank == $rank) {
                $card->due = $newDate;
                self::saveXml($xml, $deck);
            }
        }

        // Update the repetition number
        foreach ($xml->children() as $card) {
            if ($card->rank == $rank) {
                $card->repNum = $repNum + 1;
                self::saveXml($xml, $deck);
            }
        }
    }

    static function resetStats($deck) {

        $xml = new SimpleXMLElement($deck, 0, true);

        // Set stats to default
        foreach ($xml->children() as $card) {
            $card->new = 'true';
            $card->eFactor = '2.5';
            $card->due = 'none';
            $card->repNum = '1';
        }
        self::saveXml($xml, $deck);
    }

    static function removeDeck($deck){
        // Keep blue background when processing login
        echo '<body style=\'background-color:#3b5998;\'></body>';

        session_start();
        unlink($deck) or die("Couldn't delete file");
        echo "<script>window.location='../user-controller/show-decks';</script>";
    }

    static function uploadingXml(){
        // Keep blue background when processing login
        echo '<body style=\'background-color:#3b5998;\'></body>';

        session_start();
        $username = $_SESSION['username'];
        $targetLocation = DeckModel::deckFolder() . $username . '/';

        $target_path = $targetLocation . basename( $_FILES['xml-file']['name']);

        if(move_uploaded_file($_FILES['xml-file']['tmp_name'], $target_path)) {
            //echo "The file ".  basename( $_FILES['xml-file']['name']).
            //   " has been uploaded.";
        } else {
            echo "There was an error uploading the file!";
        }
        echo "<script>window.location='../user-controller/show-decks';</script>";


    }

    static function uploadingCsv(){
        // Keep blue background when processing
        echo '<body style=\'background-color:#3b5998;\'></body>';

        session_start();
        $username = $_SESSION['username'];
        $targetLocation = DeckModel::deckFolder() . $username . '/';

        $target_path = $targetLocation . basename( $_FILES['csv-file']['name']);

        $inputFile = $_FILES['csv-file']['tmp_name'];

        // Takes name from input file for XML output file
        $nameWithoutExtension = substr($_FILES['csv-file']['name'], 0, -4);
        $outputFilename   = $targetLocation . $nameWithoutExtension . '.xml';

        $tmp = fopen($_FILES['csv-file']['tmp_name'], 'rt');

        // Creates new empty xml document with deck tags only
        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><deck></deck>');
        $headers = array('rank', 'question', 'answer', 'new', 'eFactor', 'due', 'repNum');
        $bom = pack("CCC", 0xef, 0xbb, 0xbf);

        while ( ($line = fgets($tmp)) !== false) {

            $card = $xml->addChild('card');

            //Add csv data

            //Remove BOM from start of string
            if (0 == strncmp($line, $bom, 3)) {
                $line = substr($line, 3);
            }

            //Remove newline from end of string
            $line = str_replace(array("\n","\r"), '', $line) . ',true' . ',2.5' . ',none' . ',1';

            //Separate data items
            $data = explode(",", $line);

            for ($i = 0; $i <7; $i++) {
                $card->addChild($headers[$i], $data[$i]);
            }
        }

        //Output formatted xml

        $dom = new DOMDocument('1.0');
        $dom->preserveWhiteSpace = false;
        $dom->formatOutput = true;
        $dom->loadXML($xml->asXML());
        $dom->save($outputFilename);

        echo "<script>window.location='../user-controller/show-decks';</script>";


    }


}
