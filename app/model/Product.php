<?php

namespace App\model;

/**
 * Entry of single product item
 */
class Product
{
    public static $fields = [
        'product_id',
        'quantity',
        'priority',
        'created_at'
    ];
    /**
     * @var mixed
     */
    public $product_id;

    /**
     * @var mixed
     */
    public $quantity;

    /**
     * @var mixed
     */
    public $priority;

    /**
     * @var mixed
     */
    public $created_at;

    /**
     * @param array $array
     */
    public function __construct(array $array)
    {
        foreach (self::$fields as $field) {
            $this->$field = null;
            if (!empty($array[$field])) {
                $this->$field = $array[$field];
            }
        }
    }
}