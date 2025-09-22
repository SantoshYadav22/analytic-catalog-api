<?php

namespace App\Repositories\Contracts;

interface OrderRepositoryInterface
{
    public function getFilteredOrders(int $restaurantId, array $filters);
    public function getOrderTrends(int $restaurantId, string $start, string $end);

}
