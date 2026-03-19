<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts  = Product::count();
        $totalCategories = Category::count();
        $hotProducts    = Product::where('badge', 'HOT')->count();
        $saleProducts   = Product::where('badge', 'SALE')->count();
        $latestProducts = Product::with('category')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalCategories',
            'hotProducts',
            'saleProducts',
            'latestProducts'
        ));
    }
}