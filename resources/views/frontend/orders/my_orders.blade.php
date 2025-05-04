@extends('frontend.layouts.main')
@section('title', 'My Orders')

@section('main-content')
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">My Orders</h2>
            <p class="text-muted">Here are all the orders you've placed with us.</p>
        </div>

        @forelse ($orders as $order)
            <div class="card shadow-sm mb-4 border-0 rounded-4">
                <div class="card-body p-4">
                    <div class="d-flex flex-column flex-md-row justify-content-between gap-3">
                        <!-- Images of Ordered Items -->
                        <div class="d-flex flex-wrap gap-2 align-items-center">
                            @foreach ($order->items as $item)
                                @php
                                    $image = $item->outfit->photo ?? null;
                                @endphp
                                @if ($image)
                                    <img src="{{ asset('storage/' . $image) }}" alt="Product Image" class="rounded mx-1" style="width: 60px; height: 60px; object-fit: cover;">
                                @endif
                            @endforeach
                        </div>

                        <!-- Order Info -->
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between flex-wrap mt-3 mt-md-0">
                                <div>
                                    <h5 class="mb-2">Order #{{ $order->id }}</h5>
                                    <span class="badge bg-{{ $order->status == 'completed' ? 'success' : ($order->status == 'pending' ? 'warning text-dark' : 'secondary') }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                    <p class="mt-3 mb-1"><strong>Total:</strong> Rs. {{ number_format($order->total, 2) }}</p>
                                    <p class="mb-0"><strong>Placed on:</strong> {{ $order->created_at->format('M d, Y h:i A') }}</p>
                                </div>
                                <div class="align-self-end">
                                    <a href="{{ route('frontend.orders.show', $order->id) }}" class="btn btn-outline-primary mt-3">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-5">
                <h5 class="text-muted">You have no orders yet.</h5>
                <a href="{{ route('shop') }}" class="btn btn-primary mt-3">Start Shopping</a>
            </div>
        @endforelse
    </div>
</section>
@endsection
