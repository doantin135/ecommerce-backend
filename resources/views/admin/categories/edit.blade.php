@extends('admin.layout')
@section('title', 'Sửa danh mục')
@section('content')

    <div class="card border-0 shadow-sm" style="border-radius:16px; max-width:400px;">
        <div class="card-body p-4">
            <form action="/admin/categories/{{ $category->id }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label fw-semibold">Tên danh mục</label>
                    <input type="text" name="label" class="form-control" value="{{ $category->label }}" required>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Lưu
                    </button>
                    <a href="/admin/categories" class="btn btn-outline-secondary">Hủy</a>
                </div>
            </form>
        </div>
    </div>
@endsection
