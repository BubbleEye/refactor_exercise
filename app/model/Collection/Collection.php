<?php

namespace App\model\Collection;

abstract class Collection
{
    /**
     * @var array
     */
    public $items = [];

    /**
     * @param $item
     * @return void
     */
    public function addItem($item)
    {
        $this->items[] = $item;
    }

    /**
     * @param $keycom
     * @return void
     */
    public function deleteItem($key)
    {
        unset($this->items[$key]);
    }

    /**
     * @param $key
     * @return mixed
     */
    public function getItem($key)
    {
        return $this->items[$key];
    }

}