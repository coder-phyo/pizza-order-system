@extends('admin.layouts.master')

@section('title', 'Product Detail')

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
                            <div class="ms-5">

                                <i class="fa-solid fa-arrow-left-long text-dark" onclick="history.back()"></i>

                            </div>
                            <div class="card-title">
                                {{-- <h3 class="text-center title-2"><i class="fa-solid fa-list-check"></i> Product
                                    Details
                                </h3> --}}
                            </div>

                            <div class="row">
                                <div class="col-4 offset-1">

                                    <img src="{{ asset('storage/' . $pizza->image) }}" class="shadow-sm img-thumbnail" />

                                </div>

                                <div class="col-7">
                                    <div class=" my-3 btn btn-danger text-white d-block w-50 fs-5 text-center">
                                        {{ $pizza->name }}</div>
                                    <span class=" my-3 btn btn-sm btn-dark text-white"> <i
                                            class="fa-solid me-2 fs-5 fa-money-bill-1-wave"></i>
                                        {{ $pizza->price }} Ks</span>
                                    <span class=" my-3 btn btn-sm btn-dark text-white"> <i
                                            class="fa-solid me-2 fs-5 fa-clock"></i>
                                        {{ $pizza->waiting_time }} mins</span>
                                    <span class=" my-3 btn btn-sm btn-dark text-white"> <i
                                            class="fa-solid me-2 fs-5 fa-eye"></i>
                                        {{ $pizza->view_count }}</span>
                                    <span class=" my-3 btn btn-sm btn-dark text-white"> <i
                                            class="fa-solid fa-clone me-2"></i>
                                        {{ $pizza->category_name }}</span>
                                    <span class=" my-3 btn btn-sm btn-dark text-white"> <i
                                            class="fa-solid fs-5 fa-user-clock me-2"></i>
                                        {{ $pizza->created_at->format('j-F-Y') }}</span>
                                    <p class=" my-3">
                                    <aside><i class="fa-solid fs-5 fa-message me-2"></i>Details</aside>
                                    {{ $pizza->description }}
                                    </p>

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
