<?php

require_once 'vendor/autoload.php';
use MovieApp\Actor\Actor;
use PHPUnit\Framework\TestCase;

class ActorTest extends TestCase
{
    public function testValidateNameThrowsExceptionWhenNameIsTooShort()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("Invalid name: must have a maximum length of 255 characters or minimum of 3");

        $actor = new Actor("Ab", "2000-01-01");
    }

    public function testValidateNameThrowsExceptionWhenNameIsTooLong()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("Invalid name: must have a maximum length of 255 characters or minimum of 3");

        $actor = new Actor(str_repeat("A", 256), "2000-01-01");
    }

    public function testValidateDateOfBirthThrowsExceptionWhenInvalidFormat()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("Invalid date of birth: must be in the format of YYYY-MM-DD");

        $actor = new Actor("John Doe", "01-01-2000");
    }

    public function testGetNameReturnsCorrectValue()
    {
        $actor = new Actor("John Doe", "2000-01-01");

        $this->assertEquals("John Doe", $actor->getName());
    }

    public function testGetDateOfBirthReturnsCorrectValue()
    {
        $actor = new Actor("John Doe", "2000-01-01");

        $this->assertEquals("2000-01-01", $actor->getDateOfBirth());
    }

    public function testGetUniqueIdentifierReturnsUniqueValue()
    {
        $actor1 = new Actor("John Doe", "2000-01-01");
        $actor2 = new Actor("Jane Doe", "2001-01-01");

        $this->assertNotEquals($actor1->getUniqueIdentifier(), $actor2->getUniqueIdentifier());
    }

    public function testSetNameUpdatesName()
    {
        $actor = new Actor("John Doe", "2000-01-01");

        $actor->setName("Jane Doe");

        $this->assertEquals("Jane Doe", $actor->getName());
    }

    public function testSetDateOfBirthUpdatesDateOfBirth()
    {
        $actor = new Actor("John Doe", "2000-01-01");

        $actor->setDateOfBirth("2001-01-01");

        $this->assertEquals("2001-01-01", $actor->getDateOfBirth());
    }

    public function testToArrayReturnsCorrectArray()
    {
        $actor = new Actor("John Doe", "2000-01-01");

        $expected = [
            "name" => "John Doe",
            "dateOfBirth" => "2000-01-01",
            "uniqueIdentifier" => $actor->getUniqueIdentifier()
        ];

        $this->assertEquals($expected, $actor->toArray());
    }
}
