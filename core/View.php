<?php

class View {

    static function render($view, $dataReceived = []) {

        // Split data received into individual variables
        extract($dataReceived, EXTR_SKIP);

        $file = "../app/Views/$view";

        if (is_readable($file)) {
            require $file;
        } else {
            echo "$file not found!";
        }
    }


}