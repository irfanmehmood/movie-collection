<?php

require_once 'vendor/autoload.php';

use MovieApp\Utility\JsonFormatter;
use MovieApp\Movie\MovieFactory;
use MovieApp\Actor\ActorFactory;

/** Create a movie */
$movie = MovieFactory::create($title = "Independance day", $runtime = '120', $releaseDate = '2023-03-27');

/** Create an actor one */
$actor_one = ActorFactory::create($name = "brad pit", $dateOfBirth = '2019-05-27');

/** Create an actor two */
$actor_two = ActorFactory::create($name = "bruce willis", $dateOfBirth = '2011-03-20');

/** Add actors to the movie collection */
$movie->addActor($actor_one);
$movie->addActor($actor_two);

/** Get actors listed in move sorted by age */
$actorsCollection = $movie->getActorByAgeDescending();

/** Convert movie data to a JSON */
echo ($movie->toJson(new JsonFormatter));