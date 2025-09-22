<?php

namespace App\Services;

use App\Repositories\Contracts\OrderRepositoryInterface;

class OrderService
{
    protected $orderRepo;

    public function __construct(OrderRepositoryInterface $orderRepo)
    {
        $this->orderRepo = $orderRepo;
    }

    public function getOrders($restaurantId, array $filters)
    {
        return $this->orderRepo->getFilteredOrders($restaurantId, $filters);
    }

    public function getTrends(int $restaurantId, string $start, string $end)
    {
        $orders = $this->orderRepo->getOrderTrends($restaurantId, $start, $end);

        $peakHours = $orders->groupBy('date')->map(fn($dayOrders) =>
            $dayOrders->sortByDesc('daily_orders')->first()->hour
        );

        return [
            'daily_orders' => $orders->groupBy('date')->map(fn($day) => $day->sum('daily_orders')),
            'daily_revenue' => $orders->groupBy('date')->map(fn($day) => $day->sum('daily_revenue')),
            'avg_order_value' => $orders->groupBy('date')->map(fn($day) => $day->avg('avg_order_value')),
            'peak_hour' => $peakHours
        ];
    }
}
