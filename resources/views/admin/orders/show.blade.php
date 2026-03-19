@extends('admin.layout')
@section('title', 'Chi tiết đơn hàng')
@section('content')

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row g-4">
        {{-- Danh sách sản phẩm --}}
        <div class="col-md-8">
            <div class="card border-0 shadow-sm" style="border-radius:16px;">
                <div class="card-body">
                    <h6 class="fw-bold mb-3">🛍 Sản phẩm trong đơn</h6>
                    <table class="table align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Ảnh</th>
                                <th>Tên sản phẩm</th>
                                <th>Đơn giá</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->items as $item)
                                <tr>
                                    <td>
                                        <img src="{{ $item->image }}" width="50" height="50"
                                            style="border-radius:8px; object-fit:cover;"
                                            onerror="this.src='https://picsum.photos/50'">
                                    </td>
                                    <td class="fw-semibold">{{ $item->name }}</td>
                                    <td>{{ is_numeric($item->price) ? number_format($item->price) . '₫' : $item->price }}
                                    </td>
                                    <td>x{{ $item->quantity }}</td>
                                    <td class="text-danger fw-bold">
                                        {{ is_numeric($item->price) ? number_format($item->price * $item->quantity) . '₫' : $item->price }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4" class="text-end fw-bold">Tổng cộng:</td>
                                <td class="text-danger fw-bold fs-5">
                                    {{ number_format($order->total) }}₫
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            {{-- Thông tin khách hàng --}}
            <div class="card border-0 shadow-sm mb-3" style="border-radius:16px;">
                <div class="card-body">
                    <h6 class="fw-bold mb-3">👤 Thông tin khách hàng</h6>
                    <p class="mb-2">
                        <i class="bi bi-person"></i>
                        <strong> Tên:</strong> {{ $order->user_name }}
                    </p>
                    <p class="mb-2">
                        <i class="bi bi-telephone"></i>
                        <strong> SĐT:</strong> {{ $order->phone }}
                    </p>
                    <p class="mb-2">
                        <i class="bi bi-geo-alt"></i>
                        <strong> Địa chỉ:</strong> {{ $order->address }}
                    </p>
                    <p class="mb-2">
                        <i class="bi bi-credit-card"></i>
                        <strong> Thanh toán:</strong>
                        {{ $order->payment_method === 'cod' ? '🚚 COD' : '🏦 Banking' }}
                    </p>
                    @if ($order->note)
                        <p class="mb-0">
                            <i class="bi bi-chat-text"></i>
                            <strong> Ghi chú:</strong> {{ $order->note }}
                        </p>
                    @endif
                </div>
            </div>

            {{-- Cập nhật trạng thái --}}
            <div class="card border-0 shadow-sm" style="border-radius:16px;">
                <div class="card-body">
                    <h6 class="fw-bold mb-3">📦 Cập nhật trạng thái</h6>
                    <form action="/admin/orders/{{ $order->id }}/status" method="POST">
                        @csrf
                        @method('PUT')
                        <select name="status" class="form-select mb-3">
                            <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>⏳ Chờ xác nhận
                            </option>
                            <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>⚙️ Đang xử
                                lý</option>
                            <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>🚚 Đang giao
                            </option>
                            <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>✅ Đã giao
                            </option>
                            <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>❌ Đã hủy
                            </option>
                        </select>
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-check-lg"></i> Cập nhật
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-3">
        <a href="/admin/orders" class="btn btn-outline-secondary">
            ← Quay lại danh sách
        </a>
    </div>
@endsection
