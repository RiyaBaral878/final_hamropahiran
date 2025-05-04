@extends('backend.layouts.main')

@section('title', 'Add New User')

@section('main-content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> Add New User</h4>

        <div class="row">
            <div class="col">
                <div class="card mb-4">
                    <h5 class="card-header">Create New User</h5>
                    <div class="card-body demo-vertical-spacing demo-only-element">
                        <form action="{{ route('admin.users.store') }}" method="POST">
                            @csrf
                            @include('backend.users._form', ['user' => null])
                            <button type="submit" class="btn btn-success">Create User</button>
                            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
