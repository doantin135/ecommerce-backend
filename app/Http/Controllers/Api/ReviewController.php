<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    // GET /api/products/{id}/reviews
    public function index($productId)
    {
        $reviews = Review::where('product_id', $productId)
            ->latest()
            ->get();

        $avgRating = $reviews->avg('rating');
        $totalReviews = $reviews->count();

        return response()->json([
            'reviews'      => $reviews,
            'avg_rating'   => round($avgRating, 1),
            'total'        => $totalReviews,
        ]);
    }

    // POST /api/products/{id}/reviews
    public function store(Request $request, $productId)
    {
        $data = $request->validate([
            'user_id'   => 'required|string',
            'user_name' => 'required|string',
            'rating'    => 'required|numeric|min:1|max:5',
            'comment'   => 'nullable|string|max:500',
        ]);

        // Kiểm tra đã review chưa
        $existing = Review::where('product_id', $productId)
            ->where('user_id', $data['user_id'])
            ->first();

        if ($existing) {
            return response()->json(['message' => 'Bạn đã đánh giá sản phẩm này rồi'], 422);
        }

        $review = Review::create([
            ...$data,
            'product_id' => $productId,
        ]);

        // Cập nhật rating trung bình cho product
        $avgRating = Review::where('product_id', $productId)->avg('rating');
        Product::where('id', $productId)->update(['rating' => round($avgRating, 1)]);

        return response()->json([
            'message' => 'Đánh giá thành công',
            'review'  => $review,
        ], 201);
    }

    // DELETE /api/reviews/{id}
    public function destroy(Request $request, $id)
    {
        $review = Review::findOrFail($id);

        if ($review->user_id !== $request->input('user_id')) {
            return response()->json(['message' => 'Không có quyền xóa'], 403);
        }

        $review->delete();
        return response()->json(['message' => 'Đã xóa đánh giá']);
    }
}