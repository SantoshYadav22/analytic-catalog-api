<?php

namespace App\Services;

use App\Repositories\Contracts\RestaurantRepositoryInterface;

class RestaurantService
{
    protected $restaurantRepo;

    public function __construct(RestaurantRepositoryInterface $restaurantRepo)
    {
        $this->restaurantRepo = $restaurantRepo;
    }

    public function listRestaurants(array $filters, int $perPage = 10)
    {
        return $this->restaurantRepo->list($filters, $perPage);
    }

    public function topRevenue(string $start, string $end)
    {
        return $this->restaurantRepo->topRevenue($start, $end);
    }
}
