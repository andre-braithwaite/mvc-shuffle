<?php

class DeckModel {

    static function deckFolder() {
        return '../app/models/data/';
    }


    static function getField($deck, $rank, $field) {

        $xml = new SimpleXMLElement($deck, 0, true);

        foreach ($xml->children() as $card) {
            if ($rank == $card->rank) {
                return (string)$card->$field;
            }
        }
    }


    static function getDecks($decksDir) {

        $decks = array();

        if($decksDir) {
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
    static function numNew($xmlName) {

        $xml = new SimpleXMLElement($xmlName, 0, true);
        $totalCards = 0;

        foreach ($xml->children() as $card) {
            if ($card->new == "true") {
                $totalCards += 1;
            }
        }
        return $totalCards;
    }


    // Save xml file
    static function saveXml($xml, $xmlName) {
        $outputFilename = (string)$xml;
        $dom = new DOMDocument('1.0');
        $dom->preserveWhiteSpace = false;
        $dom->formatOutput = true;
        $dom->loadXML($xml->asXML());
        $dom->save($xmlName);
    }


    // Returns rank of first card marked as new and
    static function getNewCard($xmlName) {

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
}
