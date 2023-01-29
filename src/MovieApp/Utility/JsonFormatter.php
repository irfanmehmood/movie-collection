<?php

namespace MovieApp\Utility;

class JsonFormatter implements DataFormatterInterface
{
    public static function write($array): string
    {
        return json_encode($array);
    }
}