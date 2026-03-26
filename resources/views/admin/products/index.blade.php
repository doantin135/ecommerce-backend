@extends('admin.layout')
@section('title', 'Quản lý sản phẩm')
@section('content')

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm" style="border-radius:16px;">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="fw-bold mb-0">Danh sách sản phẩm</h6>
                <a href="/admin/products/create" class="btn btn-primary btn-sm">
                    <i class="bi bi-plus-lg"></i> Thêm sản phẩm
                </a>
            </div>
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Danh mục</th>
                        <th>Giá</th>
                        <th>Badge</th>
                        <th>Rating</th>
                        <th>Đã bán</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr>
                            <td>
                                <img src="{{ $product->image }}" width="50" height="50"
                                    style="border-radius:8px; object-fit:cover;">
                            </td>
                            <td class="fw-semibold">{{ $product->name }}</td>
                            <td>
                                <span class="badge bg-light text-dark">
                                    {{ $product->category?->label ?? 'N/A' }}
                                </span>
                            </td>
                            <td class="text-danger fw-bold">{{ number_format($product->price) }}₫</td>
                            <td>
                                @switch($product->badge)
                                    @case('HOT')
                                        <span class="badge bg-danger">HOT</span>
                                    @break

                                    @case('SALE')
                                        <span class="badge bg-warning text-dark">SALE</span>
                                    @break

                                    @default
                                        <span class="text-muted">—</span>
                                @endswitch
                            </td>
                            <td>
                                <i class="bi bi-star-fill text-warning"></i> {{ $product->rating }}
                            </td>
                            <td>{{ $product->sold }}</td>
                            <td>
                                <a href="/admin/products/{{ $product->id }}/edit" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="/admin/products/{{ $product->id }}" method="POST" style="display:inline;"
                                    onsubmit="return confirm('Bạn có chắc muốn xóa?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">
                                    Chưa có sản phẩm nào
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    @endsection
