<?php

namespace MovieApp\Actor;
use MovieApp\Utility\DataFormatterInterface;

abstract class ActorAbstract implements ActorInterface {

    protected string $name;
    protected string $dateOfBirth;
    protected string $uniqueIdentifier;

    public function __construct(string $name, string $dateOfBirth)
    {
        $this->validateName($name);
        $this->validateDateOfBirth($dateOfBirth);

        $this->name = $name;
        $this->dateOfBirth = $dateOfBirth;
        $this->uniqueIdentifier = $this->setUniqueIdentifier();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getUniqueIdentifier(): string
    {
        return $this->uniqueIdentifier;
    }

    public function getDateOfBirth(): string
    {
        return $this->dateOfBirth;
    }

    protected function setUniqueIdentifier(): string
    {
        return uniqid();
    }

    protected function validateName($name): bool
    {
        if (strlen($name) > 255 || strlen($name) < 3) {
            throw new \Exception("Invalid name: must have a maximum length of 255 characters or minimum of 3");
        }
        return true;
    }

    protected function validateDateOfBirth($dob): bool
    {
        if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $dob)) {
            throw new \Exception("Invalid date of birth: must be in the format of YYYY-MM-DD");
        }
        return true;
    }

    public function toArray(): array
    {
        return array(
            "name" =>  $this->getName(),
            "dateOfBirth" => $this->getDateOfBirth(),
            "uniqueIdentifier" => $this->getUniqueIdentifier()
        );
    }

    public function setName($value)
    {
        $this->validateName($value);
        $this->name = $value;
    }

    public function setDateOfBirth($value)
    {
        $this->validateDateOfBirth($value);
        $this->dateOfBirth = $value;
    }

    public function toJson(DataFormatterInterface $jsonFormatter): string
    {
        return $jsonFormatter::write($this->toArray());
    }
    
}