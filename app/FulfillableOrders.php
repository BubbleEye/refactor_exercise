<?php

namespace App;

use App\Processors\OrdersProcessor;
use App\Processors\StockProcessor;
use Exception;

/**
 *
 */
class FulfillableOrders
{
    public function run($file): Display
    {
        try {
            $json = (new Command())->parameter;
            $order = (new OrdersProcessor())
                ->setFile($file)
                ->fromFile()
                ->orderBy('priority', 'desc')
                ->orderBy('created_at')
                ->getOrder();
            $stock = (new StockProcessor())->setJson($json)->fromJson()->getStock();
        } catch (Exception $exception) {
            exit($exception->getMessage());
        }
        return (new Display($order, $stock))->render();
    }
}