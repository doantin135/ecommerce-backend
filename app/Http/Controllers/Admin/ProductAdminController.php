<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductAdminController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|string',
            'category_id' => 'nullable|exists:categories,id',
            'badge'       => 'nullable|in:HOT,SALE',
            'image'       => 'nullable|string',
            'rating'      => 'nullable|string',
            'sold'        => 'nullable|string',
        ]);

        Product::create($request->all());
        return redirect('/admin/products')->with('success', 'Thêm sản phẩm thành công!');
    }

    public function edit($id)
    {
        $product    = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|string',
            'category_id' => 'nullable|exists:categories,id',
            'badge'       => 'nullable|in:HOT,SALE',
            'image'       => 'nullable|string',
            'rating'      => 'nullable|string',
            'sold'        => 'nullable|string',
        ]);

        $product->update($request->all());
        return redirect('/admin/products')->with('success', 'Cập nhật thành công!');
    }

    public function destroy($id)
    {
        Product::findOrFail($id)->delete();
        return redirect('/admin/products')->with('success', 'Xóa thành công!');
    }
}