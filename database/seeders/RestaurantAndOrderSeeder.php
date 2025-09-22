<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Restaurant;
use App\Models\Order;

class RestaurantAndOrderSeeder extends Seeder
{
    public function run()
    {
        $restaurants = json_decode(file_get_contents(database_path('data/restaurants.json')), true);
        $orders = json_decode(file_get_contents(database_path('data/orders.json')), true);
        foreach ($restaurants as $restaurantData) {
            unset($restaurantData['id']);
            Restaurant::create($restaurantData);
        }

        foreach ($orders as $ordersData) {
            unset($ordersData['id']);
            Order::create( $ordersData);
        }
    }
}
