<?php

namespace App\Repositories;

use App\Models\Restaurant;
use Illuminate\Support\Facades\Cache;
use App\Repositories\Contracts\RestaurantRepositoryInterface;

class RestaurantRepository implements RestaurantRepositoryInterface
{
    public function list(array $filters, int $perPage = 10)
    {
        $page = request()->get('page', 1);
        $cacheKey = 'restaurants_with_orders_' . md5(json_encode($filters) . "_page_{$page}");

        return Cache::remember($cacheKey, now()->addMinutes(5), function () use ($filters, $perPage) {
            $query = Restaurant::query()->withSum('orders', 'order_amount'); // sum of order_amount

            if (!empty($filters['q'])) {
                $query->where('name', 'like', '%' . $filters['q'] . '%');
            }
            if (!empty($filters['location'])) {
                $query->where('location', $filters['location']);
            }
            if (!empty($filters['cuisine'])) {
                $query->where('cuisine', $filters['cuisine']);
            }

            return $query->paginate($perPage);
        });
    }

    public function topRevenue(string $start, string $end)
    {
        $cacheKey = "top_restaurants_{$start}_{$end}";
        return Cache::remember($cacheKey, 3600, function () use ($start, $end) {
            return Restaurant::withSum(['orders' => function ($q) use ($start, $end) {
                $q->whereBetween('order_time', [$start, $end]);
            }], 'order_amount')
                ->orderByDesc('orders_sum_order_amount')
                ->take(3)
                ->get();
        });
    }
}
