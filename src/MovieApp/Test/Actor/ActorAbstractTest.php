<?php

require_once 'vendor/autoload.php';

use MovieApp\Actor\Actor;
use PHPUnit\Framework\TestCase;
use MovieApp\Utility\JsonFormatter;

class ActorAbstractTest extends TestCase {

    public function testNameValidation() {
        $this->expectException(\Exception::class);
        $actor = new Actor('a', '2000-01-01');
    }
    
    public function testDobValidation() {
        $this->expectException(\Exception::class);
        $actor = new Actor('John Doe', '2000-13-01');
    }

    public function testGetName() {
        $actor = new Actor('John Doe', '2000-01-01');
        $this->assertEquals($actor->getName(), 'John Doe');
    }

    public function testGetUniqueIdentifier() {
        $actor = new Actor('John Doe', '2000-01-01');
        $this->assertNotEmpty($actor->getUniqueIdentifier());
    }

    public function testGetDateOfBirth() {
        $actor = new Actor('John Doe', '2000-01-01');
        $this->assertEquals($actor->getDateOfBirth(), '2000-01-01');
    }

    public function testToArray() {
        $actor = new Actor('John Doe', '2000-01-01');
        $this->assertIsArray($actor->toArray());
        $this->assertArrayHasKey('name', $actor->toArray());
        $this->assertArrayHasKey('dateOfBirth', $actor->toArray());
        $this->assertArrayHasKey('uniqueIdentifier', $actor->toArray());
    }

    public function testSetName() {
        $actor = new Actor('John Doe', '2000-01-01');
        $actor->setName('Jane Doe');
        $this->assertEquals($actor->getName(), 'Jane Doe');
    }

    public function testSetDateOfBirth() {
        $actor = new Actor('John Doe', '2000-01-01');
        $actor->setDateOfBirth('2001-01-01');
        $this->assertEquals($actor->getDateOfBirth(), '2001-01-01');
    }

    public function testToJson() {
        $actor = new Actor('John Doe', '2000-01-01');
        $this->assertJsonStringEqualsJsonString($actor->toJson(new JsonFormatter), '{"name":"John Doe","dateOfBirth":"2000-01-01","uniqueIdentifier":"' . $actor->getUniqueIdentifier(). '"}');
    }
}
