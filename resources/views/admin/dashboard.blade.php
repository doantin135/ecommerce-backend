@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')

    {{-- Stat Cards --}}
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="stat-card card bg-primary text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-white-50 mb-1">Tổng sản phẩm</div>
                        <div style="font-size:32px; font-weight:800;">{{ $totalProducts }}</div>
                    </div>
                    <i class="bi bi-box-seam" style="font-size:40px; opacity:0.4;"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card card bg-success text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-white-50 mb-1">Danh mục</div>
                        <div style="font-size:32px; font-weight:800;">{{ $totalCategories }}</div>
                    </div>
                    <i class="bi bi-tags" style="font-size:40px; opacity:0.4;"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card card bg-danger text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-white-50 mb-1">Sản phẩm HOT</div>
                        <div style="font-size:32px; font-weight:800;">{{ $hotProducts }}</div>
                    </div>
                    <i class="bi bi-fire" style="font-size:40px; opacity:0.4;"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card card bg-warning text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-white-50 mb-1">Sản phẩm SALE</div>
                        <div style="font-size:32px; font-weight:800;">{{ $saleProducts }}</div>
                    </div>
                    <i class="bi bi-percent" style="font-size:40px; opacity:0.4;"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Latest Products --}}
    <div class="card border-0 shadow-sm" style="border-radius:16px;">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="fw-bold mb-0">Sản phẩm mới nhất</h6>
                <a href="/admin/products" class="btn btn-sm btn-outline-primary">Xem tất cả</a>
            </div>
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Danh mục</th>
                        <th>Giá</th>
                        <th>Badge</th>
                        <th>Đã bán</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($latestProducts as $product)
                        <tr>
                            <td>
                                <img src="{{ $product->image }}" width="50" height="50"
                                    style="border-radius:8px; object-fit:cover;">
                            </td>
                            <td class="fw-600">{{ $product->name }}</td>
                            <td>
                                <span class="badge bg-light text-dark">
                                    {{ $product->category?->label ?? 'N/A' }}
                                </span>
                            </td>
                            <td class="text-danger fw-bold">{{ $product->price }}</td>
                            <td>
                                @if ($product->badge === 'HOT')
                                    <span class="badge bg-danger">HOT</span>
                                @elseif($product->badge === 'SALE')
                                    <span class="badge bg-warning text-dark">SALE</span>
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                            <td>{{ $product->sold }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
