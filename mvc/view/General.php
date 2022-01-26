<?php

class General {
    public static function go($place) {
        header("Location: $place");
        die();
    }
}