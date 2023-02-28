@extends('admin.layouts.master')

@section('title', 'Product Detail')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">

        <div class="section__content section__content--p30">
            <div class="container-fluid">

                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="ms-3">

                                <i class="fa-solid fa-arrow-left-long text-dark" onclick="history.back()"></i>

                            </div>

                            <div class="row">

                                <div class="col-7">
                                    <div class=" my-3 btn btn-sm btn-dark text-white"> <i class="fa-solid fa-user me-2"></i>
                                        {{ $contact->name }}</div>
                                    <div class=" my-3 btn btn-sm btn-dark text-white"> <i
                                            class="fa-solid fa-envelope me-2"></i>
                                        {{ $contact->email }}</div>
                                    <p class=" my-3">
                                    <aside><i class="fa-solid fs-5 fa-message me-2"></i>Message</aside>
                                    {{ $contact->message }}
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
