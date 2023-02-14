{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h1>User Home Page</h1>
    <h3>Role - {{ Auth::user()->role }}</h3>

    <form action="{{ route('logout') }}" method="post">
        @csrf
        <input type="submit" value="Logout">
    </form>
</body>

</html> --}}

@extends('user.layouts.master')

@section('title', 'Home Page')

@section('content')
    <!-- Shop Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Price Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter
                        by price</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                        <div
                            class=" custom-checkbox d-flex align-items-center justify-content-between mb-3 text-secondary bg-dark px-3 py-1 ">

                            <label class="mt-2" for="price-all">Categories</label>
                            <span class="badge border font-weight-normal">{{ count($category) }}</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">

                            <a href="{{ route('user#home') }}" class="text-dark">
                                {{-- <input type="checkbox" class="custom-control-input" id="{{ $c->id }}"> --}}
                                <label class="" for="">All</label>
                            </a>
                        </div>
                        @foreach ($category as $c)
                            <div
                                class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">

                                <a href="{{ route('user#filter', $c->id) }}" class="text-dark">
                                    {{-- <input type="checkbox" class="custom-control-input" id="{{ $c->id }}"> --}}
                                    <label class="" for="">{{ $c->name }}</label>
                                </a>
                            </div>
                        @endforeach
                    </form>
                </div>
                <!-- Price End -->

                <div class="">
                    <button class="btn btn btn-warning w-100">Order</button>
                </div>
                <!-- Size End -->
            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div class="shadow-sm">
                                <a href="{{ route('user#cartList') }}">
                                    <button type="button" class="btn btn-light position-relative fs-5">
                                        <i class="fa-solid fa-cart-plus"></i>
                                        <span
                                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                            {{ count($cart) }}
                                            <span class="visually-hidden">unread messages</span>
                                        </span>
                                    </button>
                                </a>
                            </div>
                            <div class="ml-2">
                                <div class="btn-group">
                                    <select value="sorting" id="sortingOption" class="btn btn-light dropdown-toggle"
                                        data-toggle="dropdown">
                                        <option value="">Choose Option...</option>
                                        <option value="asc">Ascending</option>
                                        <option value="desc">Descending</option>
                                    </select>
                                    {{-- <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" id="ascending" href="#">Ascending</a>
                                        <a class="dropdown-item" href="#">Descending</a>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row" id="dataList">
                        @if (count($pizza) != 0)
                            @foreach ($pizza as $p)
                                <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                    <div class="product-item bg-light mb-4">
                                        <div class="product-img position-relative overflow-hidden">
                                            <img class="img-fluid w-100" style="height:220px"
                                                src="{{ asset('storage/' . $p->image) }}" alt="">
                                            <div class="product-action">
                                                <a class="btn btn-outline-dark btn-square" href=""><i
                                                        class="fa fa-shopping-cart"></i></a>
                                                <a class="btn btn-outline-dark btn-square"
                                                    href="{{ route('user#pizzaDetails', $p->id) }}"><i
                                                        class="fa-solid fa-circle-info"></i></a>

                                            </div>
                                        </div>
                                        <div class="text-center py-4">
                                            <a class="h6 text-decoration-none text-truncate"
                                                href="">{{ $p->name }}</a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <h5>{{ $p->price }} kyats</h5>
                                                <h6 class="text-muted ml-2"><del>25000</del></h6>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-center mb-1">
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <h2 class="shadow-sm py-4 text-center col-6 offset-3 mt-5">There is no Pizza <i
                                    class="fa-solid fa-pizza-slice ms-3"></i></h2>
                        @endif
                    </div>

                </div>
            </div>
        </div>
        <!-- Shop Product End -->
    </div>
    <!-- Shop End -->
@endsection

@section('scriptSource')
    <script>
        $(document).ready(function() {

            $('#sortingOption').change(function() {
                $eventOption = $('#sortingOption').val();

                if ($eventOption === 'asc') {
                    $.ajax({
                        type: 'get',
                        url: 'http://127.0.0.1:8000/user/ajax/pizzaList',
                        data: {
                            'status': 'asc'
                        },
                        dataType: 'json',
                        success: function(response) {
                            $list = '';

                            $.each(response, function(index, value) {
                                $list += `
                                    <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                <div class="product-item bg-light mb-4">
                                    <div class="product-img position-relative overflow-hidden">
                                        <img class="img-fluid w-100" style="height:220px"
                                            src="{{ asset('storage/${value.image}') }}" alt="">
                                        <div class="product-action">
                                            <a class="btn btn-outline-dark btn-square" href=""><i
                                                    class="fa fa-shopping-cart"></i></a>
                                            <a class="btn btn-outline-dark btn-square" href=""><i
                                                    class="fa-solid fa-circle-info"></i></a>

                                        </div>
                                    </div>
                                    <div class="text-center py-4">
                                        <a class="h6 text-decoration-none text-truncate"
                                            href="">${value.name}</a>
                                        <div class="d-flex align-items-center justify-content-center mt-2">
                                            <h5>${value.price} kyats</h5>
                                            <h6 class="text-muted ml-2"><del>25000</del></h6>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-center mb-1">
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                `;
                            });

                            $('#dataList').html($list);
                        }
                    });
                } else if ($eventOption === 'desc') {
                    $.ajax({
                        type: 'get',
                        url: 'http://127.0.0.1:8000/user/ajax/pizzaList',
                        data: {
                            'status': 'desc'
                        },
                        dataType: 'json',
                        success: function(response) {
                            $list = '';

                            $.each(response, function(index, value) {
                                $list += `
                                    <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                <div class="product-item bg-light mb-4">
                                    <div class="product-img position-relative overflow-hidden">
                                        <img class="img-fluid w-100" style="height:220px"
                                            src="{{ asset('storage/${value.image}') }}" alt="">
                                        <div class="product-action">
                                            <a class="btn btn-outline-dark btn-square" href=""><i
                                                    class="fa fa-shopping-cart"></i></a>
                                            <a class="btn btn-outline-dark btn-square" href=""><i
                                                    class="fa-solid fa-circle-info"></i></a>

                                        </div>
                                    </div>
                                    <div class="text-center py-4">
                                        <a class="h6 text-decoration-none text-truncate"
                                            href="">${value.name}</a>
                                        <div class="d-flex align-items-center justify-content-center mt-2">
                                            <h5>${value.price} kyats</h5>
                                            <h6 class="text-muted ml-2"><del>25000</del></h6>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-center mb-1">
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                `;
                            });

                            $('#dataList').html($list);
                        }
                    });
                }
            })
        })
    </script>
@endsection
