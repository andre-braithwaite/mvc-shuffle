<?php

class DeckModel {

    static function deckFolder() {
        return '../app/models/data/';
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
