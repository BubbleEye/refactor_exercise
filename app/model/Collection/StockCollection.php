<?php

namespace App\model;

use App\model\Collection\Collection;

/**
 * Collection of stock products
 */
class StockCollection extends Collection
{
    /**
     * @param Product $item
     * @return void
     */
    public function addItem($item)
    {
        $this->items[$item->product_id] = $item->quantity;
    }
}