@extends('backend.layouts.main')

@section('title', 'Sellers\' Outfits')

@section('main-content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Dashboard /</span> Sellers' Outfits
    </h4>

    <a href="{{ route('admin.sellers-outfits.create') }}" class="btn btn-primary mb-3">Add Outfit</a>

    @foreach ($outfits as $sellerName => $sellerOutfits)
        <div class="card mb-4">
            <h5 class="card-header">{{ $sellerName }}</h5>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Outfit Name</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sellerOutfits as $outfit)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $outfit->outfit->name ?? 'N/A' }}</td>
                                    <td>Rs. {{ number_format($outfit->price, 2) }}</td>
                                    <td>{{ $outfit->stock }}</td>
                                    <td>
                                        <a href="{{ route('admin.sellers-outfits.edit', $outfit->id) }}" class="btn btn-warning btn-sm">Edit</a>

                                        <form action="{{ route('admin.sellers-outfits.destroy', $outfit->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this outfit?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>

                                        <a href="{{ route('admin.sellers-outfits.show', $outfit->id) }}" class="btn btn-info btn-sm">View</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
