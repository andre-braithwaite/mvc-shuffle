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

        foreach ($xml->children() as $card) {
            if ($card->new == "true") {
                $card->new = "false";
                // save changing card to false
                self::saveXml($xml, $xmlName);
                return (string)$card->rank;
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


}
