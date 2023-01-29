

# Movie collection

## Requirements
* Each entity must have a unique identifier.
* The Movie entity must hold the title, runtime and release date.
* The Actor entity must hold the name and date of birth.
* For all properties consider validation of the values.
* Each entity must contain a method that returns its data as JSON.
* Also provide methods for retrieving the values of each property individually.
* Movies must hold a collection of Actors and the characters being portrayed.
* The Movie entity requires a method of retrieving all Actors ordered by descending age.


## Run project
* composer update
* php index.php (get results)


## Code file
```php
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

/** Get actors listed in the movie sorted by age */
$actorsCollection = $movie->getActorByAgeDescending();

/** Convert movie data to a JSON */
echo ($movie->toJson(new JsonFormatter));
```

## Code output

```json

{
    "title": "Independance day",
    "runtime": 120,
    "releaseDate": "2023-03-27",
    "uniqueIdentifier": "63d6bc400c020",
    "actors": [
        {
            "name": "brad pit",
            "dateOfBirth": "2019-05-27",
            "uniqueIdentifier": "63d6bc400c03e"
        },
        {
            "name": "bruce willis",
            "dateOfBirth": "2011-03-20",
            "uniqueIdentifier": "63d6bc400c040"
        }
    ]
}

```

## What more could be done
* More refactoring i.e validation rules, unique identifier as an interface for movie and actor to implement
* More code refactoring
* More code coverage for testing
* Code commenting & documentation