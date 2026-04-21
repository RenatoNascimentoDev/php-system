<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderApiController extends Controller
{
    public function index()
    {
        $orders = Order::query()
            ->latest()
            ->get();

        return response()->json([
            'data' => $orders,
        ]);
    }

    public function show(Order $order)
    {
        return response()->json([
            'data' => $order,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'description' => ['required', 'string', 'max:255'],
            'customer_name' => ['required', 'string', 'max:255'],
            'product' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $data['total'] = (float) $data['price'] * (int) $data['quantity'];

        $order = Order::create($data);

        return response()->json([
            'message' => 'Pedido cadastrado com sucesso.',
            'data' => $order,
        ], 201);
    }
}
