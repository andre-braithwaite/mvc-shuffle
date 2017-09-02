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
}
