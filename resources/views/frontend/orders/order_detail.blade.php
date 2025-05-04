@extends('frontend.layouts.main')
@section('title', 'Order Details')

@section('main-content')
<section class="py-5 bg-light">
    <div class="container">
        <div class="mb-5 text-center">
            <h2 class="fw-bold">Order #{{ $order->id }}</h2>
            <p class="mb-1"><strong>Status:</strong>
                <span class="badge bg-{{ $order->status == 'completed' ? 'success' : ($order->status == 'pending' ? 'warning text-dark' : 'secondary') }}">
                    {{ ucfirst($order->status) }}
                </span>
            </p>
            <p class="mb-0"><strong>Total:</strong> Rs. {{ number_format($order->total, 2) }}</p>
        </div>

        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-header bg-white border-0 px-4 py-3">
                <h5 class="mb-0 fw-semibold">Order Items</h5>
            </div>
            <div class="card-body px-4 py-3">
                @forelse ($order->items as $item)
                    <div class="d-flex align-items-center border-bottom py-3">
                        @php
                            $image = $item->outfit->photo ??  null;
                        @endphp
                        @if ($image)
                            <img src="{{ asset('storage/' . $image) }}" alt="Outfit Image"
                                 class="mx-3 rounded" style="width: 70px; height: 70px; object-fit: cover;">
                        @else
                            <div class="me-3 bg-secondary rounded" style="width: 70px; height: 70px;"></div>
                        @endif

                        <div class="flex-grow-1">
                            <h6 class="mb-1">{{ $item->outfit->name }}</h6>
                            <small class="text-muted">Rs. {{ number_format($item->price, 2) }} x {{ $item->quantity }}</small>
                        </div>

                        <div class="text-end">
                            <strong>Rs. {{ number_format($item->price * $item->quantity, 2) }}</strong>
                        </div>
                    </div>
                @empty
                    <p>No items found in this order.</p>
                @endforelse
            </div>
        </div>
    </div>
</section>
@endsection
