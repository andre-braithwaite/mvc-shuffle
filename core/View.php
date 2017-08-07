<?php

class View {

    static function render($view) {

        $file = "../app/Views/$view";

        if (is_readable($file)) {
            require $file;
        } else {
            echo "$file not found!";
        }
    }


}