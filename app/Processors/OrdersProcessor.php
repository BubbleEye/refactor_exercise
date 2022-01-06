<?php

namespace App\Processors;

use App\model\OrderCollection;
use App\model\Product;
use App\Services\CsvHandlerService;
use Exception;

/**
 * Gathering orders
 */
class OrdersProcessor
{
    /**
     * @var
     */
    private $file;
    /**
     * @var
     */
    private $order;
    /**
     * @var
     */
    private $productsOrder;

    /**
     * @return $this
     * @throws Exception
     */
    public function fromFile(): self
    {
        $file = $this->file;
        if (empty($file) || ($openedFile = fopen($file, 'r')) === false) {
            throw new Exception('Can\'t open this file: ' . $file);
        }
        $pathInfo = pathinfo($file);
        switch ($pathInfo['extension']) {
            default:
            case 'csv':
                $data = (new CsvHandlerService($openedFile))->getData();
        }
        fclose($openedFile);
        $this->order = $this->createOrder($data);
        return $this;
    }

    /**
     * @param array $data
     * @return OrderCollection
     */
    private function createOrder(array $data): OrderCollection
    {
        $orderCollection = new OrderCollection();
        foreach ($data as $item) {
            $orderCollection->addItem(new Product($item));
        }
        return $orderCollection;
    }

    /**
     * @param string $column
     * @param string $direction
     * @return $this
     */
    public function orderBy(string $column, string $direction = 'asc'): self
    {
        $sortOrder = 1;
        if (strtolower($direction) === 'desc') {
            $sortOrder = -1;
        }
        $this->productsOrder[$column] = $sortOrder;
        return $this;
    }

    /**
     * @return OrderCollection
     */
    public function getOrder(): OrderCollection
    {
        $this->sorting();
        return $this->order;
    }

    private function sorting()
    {
        $productsOrder = $this->productsOrder;
        if (empty($productsOrder)) {
            return;
        }
        usort($this->order->items, function ($a, $b) use ($productsOrder) {
            $sort = 0;
            foreach ($productsOrder as $column => $direction) {
                if ($sort === 0) {
                    $sort = $direction * ($a->$column <=> $b->$column);
                }
            }
            return $sort;
        });
    }

    /**
     * @param $file
     * @return $this
     * @throws Exception
     */
    public function setFile($file): self
    {
        if (!file_exists($file)) {
            throw new Exception('File not exits: ' . $file);
        }
        $this->file = $file;
        return $this;
    }
}