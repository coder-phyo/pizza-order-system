@extends('admin.layouts.master')

@section('title', 'Order List Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">

                    <div class="row">
                        <div class="col-5">
                            <h4 class="text-muted">Search Key : <span class="text-danger">{{ request('key') }}</span>
                            </h4>
                        </div>
                        <div class="col-3 offset-4">
                            <form action="{{ route('admin#orderList') }}" method="get" class="form-group">
                                @csrf
                                <div class="input-group">
                                    <input type="search" name="key" class="form-control" placeholder="Find..."
                                        value="{{ request('key') }}">
                                    <button class="btn btn-dark text-white input-group-text">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-1 offset-10 bg-white shadow-sm text-center py-1 rounded">
                            <h4><i class="fa-solid fa-clipboard-list mr-2"></i>{{ count($order) }}</h4>
                        </div>
                    </div>

                    <div class="d-flex mb-3">
                        <label for="orderStatus" class="form-label mt-1 me-3">Order Status</label>
                        <select id="orderStatus" class="form-control col-2">
                            <option value="">
                                All</option>
                            <option value="0">
                                Pending</option>
                            <option value="1">
                                Accept</option>
                            <option value="2">
                                Reject</option>
                        </select>
                    </div>
                    @if (count($order) != 0)
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2">
                                <thead>
                                    <tr>
                                        <th>User ID</th>
                                        <th>User Name</th>
                                        <th>Order Date</th>
                                        <th>Order Code</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($order as $o)
                                        <tr class="tr-shadow my-5">
                                            <td>{{ $o->user_id }}</td>
                                            <td>{{ $o->user_name }}</td>
                                            <td>{{ $o->created_at->format('F-j-Y') }}</td>
                                            <td>{{ $o->order_code }}</td>
                                            <td>{{ $o->total_price }} kyats</td>
                                            <td>
                                                <select name="status" id="status" class="form-select">
                                                    <option value="0"
                                                        @if ($o->status === 0) selected @endif>
                                                        Pending</option>
                                                    <option value="1"
                                                        @if ($o->status === 1) selected @endif>
                                                        Accept</option>
                                                    <option value="2"
                                                        @if ($o->status === 2) selected @endif>
                                                        Reject</option>
                                                </select>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>

                        </div>
                    @else
                        <h1 class="text-muted text-center m-5">There is no Order Here!</h1>
                    @endif

                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection

@section('scriptSection')
    <script>
        $(document).ready(function() {
            $('#orderStatus').change(function() {
                $status = $('#orderStatus').val()

                $orderStatus = "";

                switch ($status) {
                    case '0':
                        $orderStatus = 0;
                        break;
                    case '1':
                        $orderStatus = 1;
                        break;
                    case '2':
                        $orderStatus = 2;
                        break;
                    default:
                        $orderStatus = "";
                        break;
                }

                $.ajax({
                    type: "get",
                    url: "http://127.0.0.1:8000/order/ajax/status",
                    data: {
                        'status': $orderStatus
                    },
                    dataType: "json",
                    success: function(response) {
                        $list = "";
                        $.each(response, function(index, item) {
                            $list += `
                            <tr class="tr-shadow my-5">
                                <td>${item.user_id}</td>
                                <td>${item.user_name}</td>
                                <td>${ item.created_at }</td>
                                <td>${ item.order_code }</td>
                                <td>${ item.total_price } kyats</td>
                                <td>
                                    <select name="status" id="status" class="form-select">
                                        <option value="${item.status}" ${item.status === 0 ? "selected" : ""}>
                                            Pending</option>
                                        <option value="${item.status}" ${item.status === 1 ? "selected" : ""}>
                                            Accept</option>
                                        <option value="${item.status}" ${item.status === 2 ? "selected" : ""}>
                                            Reject</option>
                                    </select>
                                </td>
                            </tr>
                            `;
                        })
                        $('tbody').html($list);
                    }
                })
            })
        })
    </script>
@endsection
