@extends('admin.layout')
@section('title', 'Quản lý đơn hàng')
@section('content')

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm" style="border-radius:16px;">
        <div class="card-body">
            <h6 class="fw-bold mb-3">Danh sách đơn hàng</h6>
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#ID</th>
                        <th>Khách hàng</th>
                        <th>Sản phẩm</th>
                        <th>Tổng tiền</th>
                        <th>Thanh toán</th>
                        <th>Trạng thái</th>
                        <th>Ngày đặt</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td class="fw-bold">#{{ $order->id }}</td>
                            <td>
                                <div class="fw-semibold">{{ $order->user_name }}</div>
                                <small class="text-muted">{{ $order->phone }}</small>
                            </td>
                            <td>
                                @foreach ($order->items as $item)
                                    <small class="d-block">• {{ $item->name }} x{{ $item->quantity }}</small>
                                @endforeach
                            </td>
                            <td class="text-danger fw-bold">
                                {{ number_format($order->total) }}₫
                            </td>
                            <td>
                                <span class="badge bg-light text-dark">
                                    @if ($order->payment_method === 'cod')
                                        <i class="bi bi-truck"></i> COD
                                    @else
                                        <i class="bi bi-bank"></i> Banking
                                    @endif
                                </span>
                            </td>
                            <td>
                                @php
                                    $colors = [
                                        'pending' => 'warning',
                                        'processing' => 'info',
                                        'shipped' => 'primary',
                                        'delivered' => 'success',
                                        'cancelled' => 'danger',
                                    ];
                                    $labels = [
                                        'pending' => 'Chờ xác nhận',
                                        'processing' => 'Đang xử lý',
                                        'shipped' => 'Đang giao',
                                        'delivered' => 'Đã giao',
                                        'cancelled' => 'Đã hủy',
                                    ];
                                @endphp
                                <span class="badge bg-{{ $colors[$order->status] }}">
                                    {{ $labels[$order->status] }}
                                </span>
                            </td>
                            <td>
                                <small>{{ $order->created_at->format('d/m/Y H:i') }}</small>
                            </td>
                            <td>
                                <a href="/admin/orders/{{ $order->id }}" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-eye"></i> Chi tiết
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">
                                Chưa có đơn hàng nào
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $orders->links() }}
        </div>
    </div>
@endsection
