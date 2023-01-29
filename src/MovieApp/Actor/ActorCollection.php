<?php

namespace MovieApp\Actor;

class ActorCollection implements \Iterator, \Countable
{
    private $actors = [];

    public function addActor(Actor $actor)
    {
        $this->actors[] = $actor;
    }

    public function removeActor(Actor $actor)
    {
        $key = array_search($actor, $this->actors, true);
        if($key !== false) {
            unset($this->actors[$key]);
        }
    }

    public function toArray() : array
    {
        $actors = [];
        foreach($this->actors as $actor) {
            $actors[] = $actor->toArray();
        }
        return $actors;
    }
    

    public function count(): int
    {
        return count(array($this->actors));
    }

    public function current() : mixed
    {
        return current($this->actors);
    }

    public function next() : void
    {
        next($this->actors);
    }

    public function key() : mixed
    {
        return key($this->actors);
    }

    public function valid() : bool
    {
        return key($this->actors) !== null;
    }

    public function rewind() : void
    {
        reset($this->actors);
    }

    public function sortByDateDesc()
    {
        usort($this->actors, function(Actor $a, Actor $b) {
            return $a->getDateOfBirth() <=> $b->getDateOfBirth();
        });
    }

    public function sortByDateAsc()
    {
        usort($this->actors, function(Actor $a, Actor $b) {
            return $b->getDateOfBirth() <=> $a->getDateOfBirth();
        });
    }
}