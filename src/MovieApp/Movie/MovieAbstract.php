<?php

namespace MovieApp\Movie;
use MovieApp\Actor\Actor;
use MovieApp\Actor\ActorCollection;
use MovieApp\Utility\DataFormatterInterface;


abstract class MovieAbstract implements MovieInterface{
    protected string $title;
    protected int $runtime;
    protected string $releaseDate;
    protected string $uniqueIdentifier;
    protected ActorCollection $actors;

    public function __construct(string $title, int $runtime, string $releaseDate)
    {
        $this->validateTitle($title);
        $this->validateRuntime($runtime);
        $this->validateReleaseDate($releaseDate);

        $this->title = $title;
        $this->runtime = $runtime;
        $this->releaseDate = $releaseDate;
        $this->actors = new ActorCollection;
        $this->uniqueIdentifier = $this->setUniqueIdentifier();
    }

    protected function validateTitle(string $value): bool
    {
        if (strlen($value) > 255 || strlen($value) < 3) {
            throw new \Exception("Invalid title: must have a maximum length of 255 characters or minimum of 3");
        }
        return true;
    }

    protected function validateRuntime(int $runtime): bool
    {
        if (!is_numeric($runtime) || $runtime < 0) {
            throw new \Exception("Invalid runtime: must be a positive number");
        }
        return true;
    }

    protected function validateReleaseDate($date): bool
    {
        if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $date)) {
            throw new \Exception("Invalid date of birth: must be in the format of YYYY-MM-DD");
        }
        return true;
    }

    protected function setUniqueIdentifier(): string
    {
        return uniqid();
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getUniqueIdentifier(): string
    {
        return $this->uniqueIdentifier;
    }

    public function getRuntime(): int
    {
        return $this->runtime;
    }

    public function getReleaseDate(): string
    {
        return $this->releaseDate;
    }

    public function setTitle(string $value) : void
    {
        $this->title = $value;
    }

    public function setRuntime(int $value): void
    {
        $this->runtime = $value;
    }

    public function setReleaseDate(string $value): void
    {
        $this->releaseDate = $value;
    }

    public function addActor(Actor $value): void
    {
        $this->actors->addActor($value);
    }

    public function getActors(): ActorCollection
    {
        return $this->actors;
    }

    public function getActorByAgeDescending(): ActorCollection
    {
        $this->actors->sortByDateAsc();

        return $this->actors;
    }

    public function toJson(DataFormatterInterface $jsonFormatter): string
    {
        $data = array(
            "title" => $this->getTitle(),
            "runtime" => $this->getRuntime(),
            "releaseDate" => $this->getReleaseDate(),
            "uniqueIdentifier" => $this->getUniqueIdentifier(),
            "actors" => $this->actors->toArray()
        );

        return $jsonFormatter::write($data);
    }

}
