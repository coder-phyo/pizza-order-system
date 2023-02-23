@extends('admin.layouts.master')

@section('title', 'Order List Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <div class="table-responsive table-responsive-data2">
                        <a href="{{ route('admin#orderList') }}" class="text-dark mb-3">
                            <span><i class="fa-solid fa-arrow-left-long  me-1"></i>Back</span>
                        </a>

                        <div class="card shadow-sm col-5">
                            <div class="card-body">
                                <div class="row text-center">
                                    <h4 class="card-title fw-bold"><i class="fa-solid fa-address-book me-1"></i>Order Info
                                    </h4>
                                </div>
                                <hr>
                                <div class="row mb-3">
                                    <div class="col-6"><i class="fa-solid fa-user me-2"></i>Customer Name</div>
                                    <div class="col-6">{{ strtoUpper($orderList[0]->user_name) }}</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-6"><i class="fa-solid fa-barcode me-2"></i>Order Code</div>
                                    <div class="col-6">{{ $orderList[0]->order_code }}</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-6"><i class="fa-solid fa-calendar-day me-2"></i>Order Date</div>
                                    <div class="col-6">{{ $orderList[0]->created_at->format('F-j-Y') }}</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-6"><i class="fa-solid fa-money-bill-wave me-2"></i>Total</div>
                                    <div class="col-6">{{ $order->total_price }} kyats <small
                                            class="d-block text-warning"><i
                                                class="fa-solid fa-triangle-exclamation me-2"></i>Include Delivery
                                            Charges</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Product Image</th>
                                    <th>Product Name</th>
                                    <th>Order Date</th>
                                    <th>Quantity</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($orderList as $o)
                                    <tr class="tr-shadow my-5">
                                        <td class="align-middle">{{ $o->id }}</td>
                                        <td>{{ $o->user_name }}</td>
                                        <td class="col-2"><img src="{{ asset('storage/' . $o->product_image) }}"
                                                class="img-thumbnail">
                                        </td>
                                        <td>{{ $o->product_name }}</td>
                                        <td>{{ $o->created_at->format('F-j-Y') }}</td>
                                        <td>{{ $o->qty }}</td>
                                        <td>{{ $o->total }} kyats</td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>

                    </div>

                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
