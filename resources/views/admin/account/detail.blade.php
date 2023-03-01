@extends('admin.layouts.master')

@section('title', 'Account Info')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">

        @if (session('updateSuccess'))
            <div class="col-4 offset-7">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa-solid fa-check"></i> {{ session('updateSuccess') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif
        <div class="section__content section__content--p30">
            <div class="container-fluid">

                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2"> <i class="fa-solid fa-address-book me-2"></i> Account Info
                                </h3>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-3 offset-2">
                                    @if (Auth::user()->image === null)
                                        @if (Auth::user()->gender === 'male')
                                            <img src="{{ asset('image/default_user.jpg') }}" class="img-thumnail shadow-sm">
                                        @else
                                            <img src="{{ asset('image/female_default.jfif') }}"
                                                class="img-thumnail shadow-sm">
                                        @endif
                                    @else
                                        <img src="{{ asset('storage/' . Auth::user()->image) }}"
                                            class="shadow-sm img-thumbnail" />
                                    @endif
                                </div>

                                <div class="col-5 offset-1">
                                    <h5 class="text-muted my-3"> <i class="fa-solid fa-user-pen me-2"></i>
                                        {{ Auth::user()->name }}</h5>
                                    <h5 class="text-muted my-3"> <i class="fa-solid fa-envelope me-2"></i>
                                        {{ Auth::user()->email }}</h5>
                                    <h5 class="text-muted my-3"> <i class="fa-solid fa-phone-volume me-2"></i>
                                        {{ Auth::user()->phone }}</h5>
                                    <h5 class="text-muted my-3"> <i class="fa-solid fa-venus-mars"></i>
                                        {{ Auth::user()->gender }}</h5>
                                    <h5 class="text-muted my-3"> <i class="fa-solid fa-location-dot me-2"></i>
                                        {{ Auth::user()->address }}</h5>
                                    <h5 class="text-muted my-3"> <i class="fa-solid fa-user-clock me-2"></i>
                                        {{ Auth::user()->created_at->format('j-F-Y') }}</h5>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-3 offset-2">
                                    <a href="{{ route('admin#edit') }}">
                                        <button class="btn btn-dark text-white"><i class="fa-solid fa-pen-nib me-2"></i>Edit
                                            Profile</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
