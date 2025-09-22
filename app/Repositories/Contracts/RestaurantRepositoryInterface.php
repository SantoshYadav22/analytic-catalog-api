<?php

namespace App\Repositories\Contracts;

interface RestaurantRepositoryInterface
{
    public function list(array $filters, int $perPage = 10);
    public function topRevenue(string $start, string $end);
}
