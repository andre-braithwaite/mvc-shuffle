<?php

class TestController extends Controller {

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
        $userInput = $_GET['startingNum'];
        $result = $userInput + 5;

        echo $result;
    }

}