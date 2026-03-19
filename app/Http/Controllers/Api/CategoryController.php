<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // GET /api/categories
    public function index()
    {
        return response()->json(Category::all());
    }

    // POST /api/categories
    public function store(Request $request)
    {
        $data = $request->validate(['label' => 'required|string|max:100']);
        $category = Category::create($data);
        return response()->json(['message' => 'Tạo thành công', 'data' => $category], 201);
    }

    // PUT /api/categories/{id}
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $data = $request->validate(['label' => 'required|string|max:100']);
        $category->update($data);
        return response()->json(['message' => 'Cập nhật thành công', 'data' => $category]);
    }

    // DELETE /api/categories/{id}
    public function destroy($id)
    {
        Category::findOrFail($id)->delete();
        return response()->json(['message' => 'Xóa thành công']);
    }
}