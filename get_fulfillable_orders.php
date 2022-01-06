<?php

require __DIR__ . '/bootstrap.php';

use App\FulfillableOrders;

$orders = (new FulfillableOrders())->run('orders.csv');
echo $orders->show();
