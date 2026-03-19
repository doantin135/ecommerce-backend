<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryAdminController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('products')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate(['label' => 'required|string|max:100']);
        Category::create($request->all());
        return redirect('/admin/categories')->with('success', 'Thêm danh mục thành công!');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $request->validate(['label' => 'required|string|max:100']);
        $category->update($request->all());
        return redirect('/admin/categories')->with('success', 'Cập nhật thành công!');
    }

    public function destroy($id)
    {
        Category::findOrFail($id)->delete();
        return redirect('/admin/categories')->with('success', 'Xóa thành công!');
    }
}