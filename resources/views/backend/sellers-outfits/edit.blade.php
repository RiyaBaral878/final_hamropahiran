@extends('backend.layouts.main')

@section('title', 'Edit Seller Outfit')

@section('main-content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Dashboard / Sellers' Outfits /</span> Edit Seller Outfit
    </h4>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.sellers-outfits.update', $sellerOutfit) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="outfit_id" class="form-label">Outfit</label>
                    <select name="outfit_id" id="outfit_id" class="form-control">
                        @foreach($outfits as $outfit)
                            <option value="{{ $outfit->id }}" {{ $outfit->id == $sellerOutfit->outfit_id ? 'selected' : '' }}>
                                {{ $outfit->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('outfit_id')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="seller_name" class="form-label">Seller Name</label>
                    <input type="text" class="form-control" id="seller_name" name="seller_name" value="{{ old('seller_name', $sellerOutfit->seller_name) }}" required>
                    @error('seller_name')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="seller_contact" class="form-label">Seller Contact</label>
                    <input type="text" class="form-control" id="seller_contact" name="seller_contact" value="{{ old('seller_contact', $sellerOutfit->seller_contact) }}">
                    @error('seller_contact')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="seller_address" class="form-label">Seller Address</label>
                    <textarea class="form-control" id="seller_address" name="seller_address" rows="2">{{ old('seller_address', $sellerOutfit->seller_address) }}</textarea>
                    @error('seller_address')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ old('price', $sellerOutfit->price) }}" required>
                    @error('price')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="stock" class="form-label">Stock</label>
                    <input type="number" class="form-control" id="stock" name="stock" value="{{ old('stock', $sellerOutfit->stock) }}" required>
                    @error('stock')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
                

                <button type="submit" class="btn btn-success">Update Seller Outfit</button>
            </form>
        </div>
    </div>
</div>
@endsection
