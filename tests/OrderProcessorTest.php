<?php

use App\Processors\OrdersProcessor;
use PHPUnit\Framework\TestCase;

class OrderProcessorTest extends TestCase
{
    public function testMissingFile()
    {
        $this->expectException(Exception::class);
        (new OrdersProcessor())->setFile(null);
    }
}