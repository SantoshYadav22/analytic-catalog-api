<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\RestaurantService;

class RestaurantController extends Controller
{
    protected $restaurantService;

    public function __construct(RestaurantService $restaurantService)
    {
        $this->restaurantService = $restaurantService;
    }

    public function index(Request $request)
    {
        $filters = $request->only(['q', 'location', 'cuisine']);
        return response()->json($this->restaurantService->listRestaurants($filters));
    }

    public function topRevenue(Request $request)
    {
        $start = $request->start_date ?? now()->subWeek()->toDateString();
        $end = $request->end_date ?? now()->toDateString();
        return response()->json($this->restaurantService->topRevenue($start, $end));
    }
}
