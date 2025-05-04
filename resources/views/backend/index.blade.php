@extends('backend.layouts.main')

@section('title', 'Dashboard')

@section('main-content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col mb-4 order-0">
                <div class="card">
                    <h5 class="text-primary p-2">Welcome Admin! 🎉</h5>
                    <div class="d-flex align-items-end row mx-2" style="background-image: url({{asset('backend/assets/img/illustrations/image.jpeg')}}); min-height:70dvh;
                                    background-size: contain;
                                    background-position: center;
                                    background-repeat: no-repeat;
                                    ">
                        <div class="col">
                            <div class="card-body">

                            </div>
                        </div>
                        <div class="col-sm-5 text-center text-sm-left">
                            <div class="card-body pb-0 px-0 px-md-4">
                                {{-- <img src="{{asset('backend/assets/img/illustrations/image.jpeg')}}" height="140"
                                    alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                    data-app-light-img="{{asset('backend/assets/img/illustrations/man-with-laptop-light.png')}}" />
                                --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection