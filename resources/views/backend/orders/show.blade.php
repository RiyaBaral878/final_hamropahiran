@extends('backend.layouts.main')

@section('title', 'Order Detail')

@section('main-content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Dashboard / Orders /</span> Order Detail
        </h4>

        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="mb-0">Order #{{ $order->id }} Details</h5>
            </div>

            <div class="card-body">
                <div class="mb-4">
                    <p><strong>User:</strong> {{ $order->user->name }}</p>
                    <p><strong>Status:</strong> 
                        <span class="badge bg-{{ $order->status == 'completed' ? 'success' : ($order->status == 'pending' ? 'warning' : 'secondary') }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </p>
                    <p><strong>Total Amount:</strong> Rs. {{ $order->total_amount }}</p>
                    <p><strong>Payment Method:</strong> {{ $order->payment_method ?? '-' }}</p>
                    <p><strong>Paid At:</strong> {{ $order->paid_at ? $order->paid_at->format('d M Y') : '-' }}</p>
                </div>

                <h5 class="mb-3">Order Items</h5>
                <ul class="list-group mb-4">
                    @forelse ($order->items as $item)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $item->outfit->name }} ({{ $item->quantity }} pcs)
                            <span class="text-muted">Rs. {{ $item->cost }} each</span>
                        </li>
                    @empty
                        <li class="list-group-item">No items found in this order.</li>
                    @endforelse
                </ul>

                <h5 class="mb-3">Update Status</h5>
                <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" class="row g-3 align-items-end">
                    @csrf
                    @method('PUT')
                    <div class="col-md-6">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-select" required>
                            @foreach (['pending', 'processing', 'shipped', 'delivered', 'cancelled'] as $status)
                                <option value="{{ $status }}" {{ $order->status === $status ? 'selected' : '' }}>
                                    {{ ucfirst($status) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-auto">
                        <button type="submit" class="btn btn-primary">Update Status</button>
                    </div>
                </form>

                <div class="mt-4">
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">← Back to Orders</a>
                </div>
            </div>
        </div>
    </div>
@endsection
