@extends('admin.layouts.master')

@section('title', 'Account Info')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
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
                                        <img src="{{ asset('image/default_user.jpg') }}" class="shadow-sm img-thumbnail" />
                                    @else
                                        <img src="{{ asset('admin/images/icon/avatar-big-06.jpg') }}"
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
                                    <h5 class="text-muted my-3"> <i class="fa-solid fa-location-dot me-2"></i>
                                        {{ Auth::user()->address }}</h5>
                                    <h5 class="text-muted my-3"> <i class="fa-solid fa-user-clock me-2"></i>
                                        {{ Auth::user()->created_at->format('j-F-Y') }}</h5>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-3 offset-2">
                                    <button class="btn btn-dark text-white"><i class="fa-solid fa-pen-nib me-2"></i>Edit
                                        Profile</button>
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
