<?php

/**
 * Mechanizm automatycznego ładowania klas i ich interfejsów
 */
spl_autoload_register(
    function($class_name) {

        /* Wyznaczanie ścieżki pliku */
        $path = __DIR__;
        if (str_contains($class_name, 'Question') && !str_contains($class_name, 'Response')) {
            $path .= '/question';
        }
        if (str_contains($class_name, 'Response')) {
            $path .= '/response';
        }

        /* Ładowanie pliku w którym przechowywana jest ładowana klasa / interfejs */
        require $path.'/'.$class_name.'.php';
    }
);
