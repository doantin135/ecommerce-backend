<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // GET /api/orders
    public function index()
    {
        $orders = Order::with('items')->latest()->get();
        return response()->json($orders);
    }

    // GET /api/orders/user/{userId}
    public function getByUser($userId)
    {
        $orders = Order::with('items')
            ->where('user_id', $userId)
            ->latest()
            ->get();
        return response()->json($orders);
    }

    // GET /api/orders/{id}
    public function show($id)
    {
        $order = Order::with('items')->findOrFail($id);
        return response()->json($order);
    }

    // POST /api/orders
    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id'        => 'required|string',
            'user_name'      => 'required|string',
            'user_email'     => 'nullable|string',
            'phone'          => 'required|string',
            'address'        => 'required|string',
            'total'          => 'required|numeric',
            'payment_method' => 'required|in:cod,banking',
            'note'           => 'nullable|string',
            'items'          => 'required|array',
        ]);

        $order = Order::create($data);

        foreach ($data['items'] as $item) {
            $order->items()->create([
                'product_id' => $item['product_id'],
                'name'       => $item['name'],
                'price'      => $item['price'],
                'quantity'   => $item['quantity'],
                'image'      => $item['image'] ?? null,
            ]);
        }

        return response()->json([
            'message' => 'Đặt hàng thành công',
            'order'   => $order->load('items'),
        ], 201);
    }

    // PUT /api/orders/{id}/status
    public function updateStatus(Request $request, $id)
    {
        $data = $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled',
        ]);

        $order = Order::findOrFail($id);
        $order->update(['status' => $data['status']]);

        return response()->json([
            'message' => 'Cập nhật trạng thái thành công',
            'order'   => $order,
        ]);
    }
}