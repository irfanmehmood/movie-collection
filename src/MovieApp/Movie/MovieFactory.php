<?php

namespace MovieApp\Movie;

class MovieFactory
{

    public static function create(string $title, int $runtime, string $releaseDate)
    {
        return new Movie($title, $runtime, $releaseDate);
    }
}
