@extends('backend.layouts.main')

@section('title', 'View Seller Outfit')

@section('main-content')
<div class="container-xxl flex-grow-1 container-p-y">

    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Dashboard /</span> View Seller Outfit
    </h4>

    <div class="card mb-4">
        <h5 class="card-header">{{ $outfit->seller_name }}'s Outfit Details</h5>
        <div class="card-body">

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label"><strong>Seller Name:</strong></label>
                <div class="col-sm-10">
                    {{ $outfit->seller_name }}
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label"><strong>Seller Contact:</strong></label>
                <div class="col-sm-10">
                    {{ $outfit->seller_contact ?? 'N/A' }}
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label"><strong>Seller Address:</strong></label>
                <div class="col-sm-10">
                    {{ $outfit->seller_address ?? 'N/A' }}
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label"><strong>Outfit Name:</strong></label>
                <div class="col-sm-10">
                    {{ $outfit->outfit->name ?? 'N/A' }}
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label"><strong>Price:</strong></label>
                <div class="col-sm-10">
                    Rs. {{ number_format($outfit->price, 2) }}
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label"><strong>Stock:</strong></label>
                <div class="col-sm-10">
                    {{ $outfit->stock }}
                </div>
            </div>

            @if ($outfit->outfit && $outfit->outfit->photo)
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label"><strong>Outfit Photo:</strong></label>
                    <div class="col-sm-10">
                        <img src="{{ asset('storage/' . $outfit->outfit->photo) }}" alt="Outfit Photo" class="img-fluid" style="max-height: 300px;">
                    </div>
                </div>
            @endif

            <a href="{{ route('admin.sellers-outfits.index') }}" class="btn btn-secondary mt-3">Back to List</a>
        </div>
    </div>

</div>
@endsection
