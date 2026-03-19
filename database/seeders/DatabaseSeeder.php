<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Categories
        $categories = [
            ['label' => 'Tất cả'],
            ['label' => 'Điện tử'],
            ['label' => 'Thời trang'],
            ['label' => 'Nhà cửa'],
            ['label' => 'Thể thao'],
        ];
        foreach ($categories as $cat) {
            Category::create($cat);
        }

        // Products
        $products = [
            [
                'category_id' => 2,
                'name' => 'Tai nghe Sony WH-1000XM5',
                'price' => '1.200.000₫',
                'old_price' => '1.500.000₫',
                'rating' => '4.8',
                'sold' => '1.2k',
                'image' => 'https://picsum.photos/seed/p1/300/300',
                'badge' => 'HOT',
            ],
            [
                'category_id' => 3,
                'name' => 'Giày Nike Air Max 270',
                'price' => '2.500.000₫',
                'old_price' => '3.000.000₫',
                'rating' => '4.6',
                'sold' => '980',
                'image' => 'https://picsum.photos/seed/p2/300/300',
                'badge' => 'SALE',
            ],
            [
                'category_id' => 3,
                'name' => 'Áo khoác Uniqlo Ultra Light',
                'price' => '890.000₫',
                'old_price' => null,
                'rating' => '4.7',
                'sold' => '2.1k',
                'image' => 'https://picsum.photos/seed/p3/300/300',
                'badge' => null,
            ],
            [
                'category_id' => 2,
                'name' => 'Bàn phím Logitech MX Keys',
                'price' => '1.800.000₫',
                'old_price' => '2.100.000₫',
                'rating' => '4.9',
                'sold' => '560',
                'image' => 'https://picsum.photos/seed/p4/300/300',
                'badge' => 'SALE',
            ],
        ];
        foreach ($products as $product) {
            Product::create($product);
        }
    }
}