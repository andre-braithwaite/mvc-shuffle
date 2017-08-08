<?php

class TestController {

    function testingView() {
        View::render('TestView.php', [
            'name' => 'NAME_DATA',
            'activeDeck' => 'DECK_DATA',
            'colours' => ['RED', 'GREEN', 'BLUE'],
            'fromModel' => $this->testFromModel()
        ]);
    }

    function testFromModel() {
        return LoginModel::testMethod();
    }

    function testResponse() {
        echo 'I am a test server response';
    }

}