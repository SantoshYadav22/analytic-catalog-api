<?php

namespace App\Repositories;

use App\Models\Restaurant;
use App\Models\Order;
use Illuminate\Support\Facades\Cache;
use App\Repositories\Contracts\OrderRepositoryInterface;

class OrderRepository implements OrderRepositoryInterface
{
    public function getFilteredOrders($restaurantId, array $filters)
    {
        $page = request()->get('page', 1);
        $cacheKey = "orders:restaurant:$restaurantId:" . md5(json_encode($filters) . ":page:$page");

        return Cache::remember($cacheKey, now()->addMinutes(10), function () use ($restaurantId, $filters, $page) {
            $restaurant = Restaurant::findOrFail($restaurantId);
            $query = Order::where('restaurant_id', $restaurantId);

            if (!empty($filters['start_date'])) {
                $query->whereDate('order_time', '>=', $filters['start_date']);
            }
            if (!empty($filters['end_date'])) {
                $query->whereDate('order_time', '<=', $filters['end_date']);
            }
            if (!empty($filters['amount_min'])) {
                $query->where('order_amount', '>=', $filters['amount_min']);
            }
            if (!empty($filters['amount_max'])) {
                $query->where('order_amount', '<=', $filters['amount_max']);
            }
            if (!empty($filters['hour_min'])) {
                $query->whereRaw('HOUR(order_time) >= ?', [$filters['hour_min']]);
            }
            if (!empty($filters['hour_max'])) {
                $query->whereRaw('HOUR(order_time) <= ?', [$filters['hour_max']]);
            }
            $totalAmount = (clone $query)->sum('order_amount');
            $orders = $query->paginate(20, ['*'], 'page', $page);

            return [
                'id' => $restaurant->id,
                'name' => $restaurant->name,
                'location' => $restaurant->location,
                'orders' => $orders,
                'orders_sum_order_amount' => $totalAmount,
            ];
        });
    }
    
    public function getOrderTrends(int $restaurantId, string $start, string $end)
    {
        $cacheKey = "orders_{$restaurantId}_{$start}_{$end}";

        return Cache::remember($cacheKey, 3600, function () use ($restaurantId, $start, $end) {
            $query = Order::where('restaurant_id', $restaurantId)
                ->whereBetween('order_time', [$start, $end]);

            return $query->selectRaw('DATE(order_time) as date, COUNT(*) as daily_orders, SUM(order_amount) as daily_revenue, AVG(order_amount) as avg_order_value, HOUR(order_time) as hour')
                ->groupBy('date', 'hour')
                ->get();
        });
    }

    
}
