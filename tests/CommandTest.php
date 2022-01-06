<?php


use app\Command;
use PHPUnit\Framework\TestCase;

class CommandTest extends TestCase
{
    public function testHasValidParameter()
    {
        $this->expectException(Exception::class);
        new Command();
    }
}