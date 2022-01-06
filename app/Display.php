<?php

namespace app;

use App\model\OrderCollection;
use App\model\Product;
use App\model\StockCollection;
use App\Processors\StockProcessor;

/**
 * Display current stock and orders
 */
class Display
{
    const SEPARATOR_SYMBOL = '=';

    const MAX_HEADER_WIDTH = 20;

    const HEAD_PRIORITY = 'priority';

    const PRIORITY_TEXT_LOW = 'low';

    const PRIORITY_TEXT_MEDIUM = 'medium';

    const PRIORITY_TEXT_HIGH = 'high';

    const PRIORITY_TEXT_NOT_SET = 'not_set';

    /**
     * @var OrderCollection
     */
    private $orders;
    /**
     * @var StockProcessor
     */
    private $stocks;
    /**
     * @var string rendered content
     */
    private $content;

    /**
     * @param OrderCollection $order
     * @param StockCollection $stock
     */
    public function __construct(OrderCollection $order, StockCollection $stock)
    {
        $this->orders = $order->items;
        $this->stocks = $stock->items;
    }

    /**
     * @return $this
     */
    public function render(): self
    {
        $rendered = $this->renderHeader();
        foreach ($this->orders as $item) {
            if ($this->stocks[$item->product_id] >= $item->quantity) {
                foreach ($item as $head => $value) {
                    if ($head === self::HEAD_PRIORITY) {
                        switch ($item->priority) {
                            case 1:
                                $text = self::PRIORITY_TEXT_LOW;
                                break;
                            case 2:
                                $text = self::PRIORITY_TEXT_MEDIUM;
                                break;
                            case 3:
                                $text = self::PRIORITY_TEXT_HIGH;
                                break;
                            default:
                                $text = self::PRIORITY_TEXT_NOT_SET;
                        }
                        $rendered .= str_pad($text, self::MAX_HEADER_WIDTH);
                    } else {
                        $rendered .= str_pad($value, self::MAX_HEADER_WIDTH);
                    }
                }
                $rendered .= "\n";
            }
        }
        $this->content = $rendered;
        return $this;
    }

    /**
     * @return string
     */
    private function renderHeader(): string
    {
        $header = Product::$fields;
        $out = "";
        foreach ($header as $head) {
            $out .= str_pad($head, self::MAX_HEADER_WIDTH);
        }
        return $out . "\n" . str_repeat(self::SEPARATOR_SYMBOL,
                (count($header) * self::MAX_HEADER_WIDTH)) . "\n";
    }

    /**
     * @return string
     */
    public function show(): string
    {
        return "\n" . $this->content . "\n";
    }
}