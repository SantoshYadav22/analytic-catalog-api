<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\OrderService;

class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index(Request $request)
    {
        $restaurantId = $request->query('restaurant_id');
        if (empty($restaurantId)) {
            return response()->json([
                'message' => 'Restaurant ID is required.'
            ], 400);
        }
        $filters = [
            'start_date' => $request->query('start_date'),
            'end_date'   => $request->query('end_date'),
            'amount_min' => $request->query('amount_min'),
            'amount_max' => $request->query('amount_max'),
            'hour_min'   => $request->query('hour_min'),
            'hour_max'   => $request->query('hour_max'),
        ];

        
        return response()->json(
            $this->orderService->getOrders($restaurantId, $filters)
        );
    }

    public function trends(Request $request)
    {
        $restaurantId = $request->query('restaurant_id');
        if (empty($restaurantId)) {
            return response()->json([
                'message' => 'Restaurant ID is required.'
            ], 400);
        }
        $start = $request->start_date ?? now()->subWeek()->toDateString();
        $end = $request->end_date ?? now()->toDateString();

        return response()->json($this->orderService->getTrends($restaurantId, $start, $end));
    }
}
