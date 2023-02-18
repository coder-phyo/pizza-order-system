@extends('user.layouts.master')

@section('title', 'History List')

@section('content')
    <!-- Cart Start -->
    <div class="container-fluid" style="height: 100vh">
        <div class="row px-xl-5">
            <div class="col-lg-8 offset-lg-2 col-sm-10 offset-sm-1 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable">
                    <thead class="thead-dark">
                        <tr class="text-start">
                            <th>Date</th>
                            <th>Order ID</th>
                            <th>Total Price</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($order as $o)
                            <tr>
                                <td class="align-middle text-start">{{ $o->created_at->format('F-j-Y') }}</td>
                                <td class="align-middle text-start">{{ $o->order_code }}</td>
                                <td class="align-middle text-start">{{ $o->total_price }}</td>
                                <td class="align-middle text-start">
                                    @if ($o->status === 0)
                                        <span class="text-warning "><i class="fa-solid fa-hourglass-half"></i>
                                            Pending...</span>
                                    @elseif ($o->status === 1)
                                        <span class="text-success "><i class="fa-solid fa-circle-check"></i>
                                            Success</span>
                                    @elseif ($o->status === 2)
                                        <span class="text-danger "><i class="fa-solid fa-triangle-exclamation"></i>
                                            Reject</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-3">
                    <span>
                        {{ $order->links() }}
                    </span>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection
