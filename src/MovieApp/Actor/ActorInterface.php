<?php

namespace MovieApp\Actor;
use MovieApp\Utility\DataFormatterInterface;

Interface ActorInterface {
    public function __construct(string $name, string $dateOfBirth);
    public function getName(): string;
    public function getUniqueIdentifier(): string;
    public function getDateOfBirth(): string;
    public function toJson(DataFormatterInterface $formatter) : string;
    public function setName(string $value);
    public function setDateOfBirth(string $value);
}