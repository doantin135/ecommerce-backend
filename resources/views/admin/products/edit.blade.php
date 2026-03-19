@extends('admin.layout')
@section('title', 'Sửa sản phẩm')
@section('content')

    <div class="card border-0 shadow-sm" style="border-radius:16px; max-width:700px;">
        <div class="card-body p-4">
            <form action="/admin/products/{{ $product->id }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label fw-semibold">Tên sản phẩm</label>
                    <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
                </div>
                <div class="row g-3 mb-3">
                    <div class="col">
                        <label class="form-label fw-semibold">Giá</label>
                        <input type="text" name="price" class="form-control" value="{{ $product->price }}" required>
                    </div>
                    <div class="col">
                        <label class="form-label fw-semibold">Giá cũ</label>
                        <input type="text" name="old_price" class="form-control" value="{{ $product->old_price }}">
                    </div>
                </div>
                <div class="row g-3 mb-3">
                    <div class="col">
                        <label class="form-label fw-semibold">Danh mục</label>
                        <select name="category_id" class="form-select">
                            <option value="">-- Chọn danh mục --</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}"
                                    {{ $product->category_id == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->label }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <label class="form-label fw-semibold">Badge</label>
                        <select name="badge" class="form-select">
                            <option value="">-- Không có --</option>
                            <option value="HOT" {{ $product->badge === 'HOT' ? 'selected' : '' }}>HOT</option>
                            <option value="SALE" {{ $product->badge === 'SALE' ? 'selected' : '' }}>SALE</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">URL Ảnh</label>
                    <input type="text" name="image" class="form-control" value="{{ $product->image }}">
                </div>
                <div class="row g-3 mb-4">
                    <div class="col">
                        <label class="form-label fw-semibold">Rating</label>
                        <input type="text" name="rating" class="form-control" value="{{ $product->rating }}">
                    </div>
                    <div class="col">
                        <label class="form-label fw-semibold">Đã bán</label>
                        <input type="text" name="sold" class="form-control" value="{{ $product->sold }}">
                    </div>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Lưu thay đổi
                    </button>
                    <a href="/admin/products" class="btn btn-outline-secondary">Hủy</a>
                </div>
            </form>
        </div>
    </div>
@endsection
