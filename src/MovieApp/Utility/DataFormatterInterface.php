<?php

namespace MovieApp\Utility;

interface DataFormatterInterface {
    public static function write($array) : string;
}