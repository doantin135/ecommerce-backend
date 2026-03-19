<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // GET /api/products?category_id=1&search=tai+nghe&badge=HOT
    public function index(Request $request)
    {
        $query = Product::with('category');

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('badge')) {
            $query->where('badge', $request->badge);
        }

        $products = $query->paginate($request->get('per_page', 10));

        return response()->json($products);
    }

    // GET /api/products/{id}
    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);
        return response()->json($product);
    }

    // POST /api/products
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|string',
            'old_price' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
            'badge' => 'nullable|in:HOT,SALE',
            'image' => 'nullable|string',
            'rating' => 'nullable|string',
            'sold' => 'nullable|string',
        ]);

        $product = Product::create($data);
        return response()->json(['message' => 'Tạo thành công', 'data' => $product], 201);
    }

    // PUT /api/products/{id}
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $data = $request->validate([
            'name' => 'sometimes|string|max:255',
            'price' => 'sometimes|string',
            'old_price' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
            'badge' => 'nullable|in:HOT,SALE',
            'image' => 'nullable|string',
            'rating' => 'nullable|string',
            'sold' => 'nullable|string',
        ]);

        $product->update($data);
        return response()->json(['message' => 'Cập nhật thành công', 'data' => $product]);
    }

    // DELETE /api/products/{id}
    public function destroy($id)
    {
        Product::findOrFail($id)->delete();
        return response()->json(['message' => 'Xóa thành công']);
    }
}