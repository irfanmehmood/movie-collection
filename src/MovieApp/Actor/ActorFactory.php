<?php

namespace MovieApp\Actor;

class ActorFactory
{
    public static function create(string $name, string $dateOfBirth)
    {
        return new Actor($name, $dateOfBirth);
    }
}
