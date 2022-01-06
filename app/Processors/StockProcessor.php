<?php

namespace App\Processors;

use App\model\Product;
use App\model\StockCollection;
use App\Services\JsonReaderService;
use Exception;

/**
 * Create stock from parameter
 */
class StockProcessor
{
    /**
     * @var
     */
    private $stock;
    /**
     * @var
     */
    private $data;

    /**
     * @return $this
     * @throws Exception
     */
    public function setJson($json): self
    {
        $this->data = JsonReaderService::load($json);
        return $this;
    }

    public function fromJson(): self
    {
        $stockCollection = new StockCollection();
        foreach ($this->data as $productId => $quantity) {
            $product = new Product([
                'product_id' => $productId,
                'quantity' => $quantity,
            ]);
            $stockCollection->addItem($product);
        }
        $this->stock = $stockCollection;
        return $this;
    }

    /**
     * @return StockCollection
     * @throws Exception
     */
    public function getStock(): StockCollection
    {
        return $this->stock;
    }
}