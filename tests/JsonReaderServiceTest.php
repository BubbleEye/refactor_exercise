<?php

use App\Services\JsonReaderService;
use PHPUnit\Framework\TestCase;

class JsonReaderServiceTest extends TestCase
{
    public function testJsonToArray()
    {
        $this->assertIsArray(JsonReaderService::load('{"1":8,"2":4,"3":5}'));
    }

    public function testJsonToArraySameResult()
    {
        $json = '{"1":8,"2":4,"3":5}';
        $array = ['1' => 8, '2' => 4, '3' => 5];
        $this->assertEquals(JsonReaderService::load($json),
            $array);
    }

    public function testValidJson()
    {
        $this->expectException(Exception::class);
        JsonReaderService::load(null);
    }
}