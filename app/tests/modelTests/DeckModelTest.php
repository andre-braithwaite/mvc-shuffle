<?php

include '../../models/DeckModel.php';

class DeckModelTest extends PHPUnit_Framework_TestCase {

    function setUp() {

        date_default_timezone_set('Europe/London');
        $this->deckModel = new DeckModel();
    }


    function test_deckFolder_returned_correct_folder() {
        $this->assertEquals('../app/models/data/', $this->deckModel->deckFolder());
    }


    function tearDown() {

        unset($this->deckModel);
    }

}
