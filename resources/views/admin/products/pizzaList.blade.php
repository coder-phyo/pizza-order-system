@extends('admin.layouts.master')

@section('title', 'Products List Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Products List</h2>

                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{ route('products#createPage') }}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>add products
                                </button>
                            </a>
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                CSV download
                            </button>
                        </div>
                    </div>

                    @if (session('createSuccess'))
                        <div class="col-5 offset-7">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-check"></i> {{ session('createSuccess') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    @if (session('deleteSuccess'))
                        <div class="col-5 offset-7">
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-circle-xmark"></i> {{ session('deleteSuccess') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif


                    <div class="row">
                        <div class="col-5">
                            <h4 class="text-muted">Search Key : <span class="text-danger">{{ request('key') }}</span>
                            </h4>
                        </div>
                        <div class="col-3 offset-4">
                            <form action="{{ route('products#list') }}" method="get" class="form-group">
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
                            <h4><i class="fa-solid fa-clipboard-list mr-2"></i>{{ $pizzas->total() }} </h4>
                        </div>
                    </div>

                    @if (count($pizzas) != 0)
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Waiting Time</th>
                                        <th>Category</th>
                                        <th>View Count</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($pizzas as $p)
                                        <tr class="tr-shadow my-5">
                                            <td class="col-2"><img src="{{ asset('storage/' . $p->image) }}"
                                                    class="img-thumbnail shadow-sm">
                                            </td>
                                            <td class="col-2">{{ $p->name }}</td>
                                            <td class="col-2">{{ $p->price }}</td>
                                            <td class="col-2">{{ $p->waiting_time }}</td>
                                            <td class="col-2">{{ $p->category_name }}</td>
                                            <td class="col-2"><i class="fa-solid fa-eye me-2"></i>{{ $p->view_count }}
                                            </td>
                                            <td class="col-2">
                                                <div class="table-data-feature ms-3">
                                                    <a href="{{ route('products#edit', $p->id) }}">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="View">
                                                            <i class="fa-solid fa-eye"></i>
                                                        </button>
                                                    </a>
                                                    <a href="{{ route('products#updatePage', $p->id) }}" class="ms-3">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="Edit">
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </button>
                                                    </a>
                                                    <a href="{{ route('products#delete', $p->id) }}" class="ms-3">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="Delete">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>

                            <div class="mt-3">
                                {{ $pizzas->links() }}
                            </div>

                        </div>
                    @else
                        <h1 class="text-muted text-center m-5">There is no Pizzas Here!Please add...</h1>
                    @endif
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
