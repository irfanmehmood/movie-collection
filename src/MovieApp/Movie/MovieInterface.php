<?php

namespace MovieApp\Movie;

use MovieApp\Actor\Actor;
use MovieApp\Actor\ActorCollection;
use MovieApp\Utility\DataFormatterInterface;


interface MovieInterface {
    public function getTitle() : string;
    public function getRuntime() : int;
    public function getReleaseDate() : string;
    public function getUniqueIdentifier() : string;
    public function getActors() : ActorCollection;
    public function addActor(Actor $value) : void;
    public function toJson(DataFormatterInterface $formatter) : string;    
}