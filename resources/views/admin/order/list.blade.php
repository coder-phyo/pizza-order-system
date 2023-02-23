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

                    <form action="{{ route('admin#changeStatus') }}" method="get" class="col-4 mb-3">
                        @csrf
                        <div class="input-group">
                            <div class="input-group-text">
                                <h4><i class="fa-solid fa-clipboard-list mr-2"></i>{{ count($order) }}</h4>
                            </div>
                            <select name="orderStatus" id="orderStatus" class="form-select col-5">
                                <option value="">
                                    All</option>
                                <option value="0" @if (request('orderStatus') === '0') selected @endif>
                                    Pending</option>
                                <option value="1" @if (request('orderStatus') === '1') selected @endif>
                                    Accept</option>
                                <option value="2" @if (request('orderStatus') === '2') selected @endif>
                                    Reject</option>
                            </select>
                            <button type="submit" class="btn btn-sm btn-outline-dark"><i
                                    class="fa-solid fa-magnifying-glass me-2"></i>Search</button>
                        </div>
                    </form>
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
                                            <input type="hidden" class="orderId" value="{{ $o->id }}">
                                            <td>{{ $o->user_id }}</td>
                                            <td>{{ $o->user_name }}</td>
                                            <td>{{ $o->created_at->format('F-j-Y') }}</td>
                                            <td><a href="{{ route('admin#listInfo', $o->order_code) }}"
                                                    class="text-primary text-decoration-none">{{ $o->order_code }}</a>
                                            </td>
                                            <td class="amount">{{ $o->total_price }} kyats</td>
                                            <td>
                                                <select name="status" class="form-select changeStatus">
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
            // $('#orderStatus').change(function() {
            //     $status = $('#orderStatus').val()

            //     $orderStatus = "";

            //     switch ($status) {
            //         case '0':
            //             $orderStatus = 0;
            //             break;
            //         case '1':
            //             $orderStatus = 1;
            //             break;
            //         case '2':
            //             $orderStatus = 2;
            //             break;
            //         default:
            //             $orderStatus = "";
            //             break;
            //     }

            //     $.ajax({
            //         type: "get",
            //         url: "http://127.0.0.1:8000/order/ajax/status",
            //         data: {
            //             status: $orderStatus
            //         },
            //         dataType: "json",
            //         success: function(response) {
            //             $list = "";
            //             $.each(response, function(index, item) {

            //                 $dbDate = new Date(item.created_at);
            //                 $months = ['January', 'February', 'March', 'April', 'May',
            //                     'June', 'July', 'August', 'September', 'October',
            //                     'November', 'December'
            //                 ]
            //                 $finalDate = $months[$dbDate.getMonth()] + "-" + $dbDate
            //                     .getDate() + "-" + $dbDate.getFullYear();

            //                 $list += `
        //                 <tr class="tr-shadow my-5">
        //                      <input type="hidden" class="orderId" value="${item.id}">
        //                     <td>${item.user_id}</td>
        //                     <td>${item.user_name}</td>
        //                     <td>${$finalDate }</td>
        //                     <td>${ item.order_code }</td>
        //                     <td>${ item.total_price } kyats</td>
        //                     <td>
        //                         <select name="status" id="status" class="form-select changeStatus">
        //                             <option value="1" ${item.status === 0 ? "selected" : ""}>
        //                                 Pending</option>
        //                             <option value="2" ${item.status === 1 ? "selected" : ""}>
        //                                 Accept</option>
        //                             <option value="3" ${item.status === 2 ? "selected" : ""}>
        //                                 Reject</option>
        //                         </select>
        //                     </td>
        //                 </tr>
        //                 `;
            //             })
            //             $('tbody').html($list);
            //         }
            //     })
            // })

            $('.changeStatus').change(function() {
                $currentStatus = $(this).val();
                $parentNode = $(this).parents("tr");
                $orderId = $parentNode.find(".orderId").val();

                $data = {
                    status: $currentStatus,
                    orderId: $orderId
                };

                console.log($data);

                $.ajax({
                    type: "get",
                    url: "http://127.0.0.1:8000/order/ajax/change/status",
                    data: $data,
                    dataType: "json",
                })

                location.reload();
            })
        })
    </script>
@endsection
