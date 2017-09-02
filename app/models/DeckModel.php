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

                    $deckName = substr($deck, 0, -4);
                    array_push($decks, $deckName);
                    //echo "<button type = submit name=\"active\" value = $deck >$deckName</button><br> ";

                }
            }
            closedir($decksDir);
        }
        return $decks;
    }
}
