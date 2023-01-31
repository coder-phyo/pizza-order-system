@extends('admin.layouts.master')

@section('title', 'Category List Page')

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
                                <h2 class="title-1">Category List</h2>

                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{ route('category#createPage') }}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>add category
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
                            <form action="{{ route('category#list') }}" method="get" class="form-group">
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
                            <h4><i class="fa-solid fa-clipboard-list mr-2"></i> {{ $categories->total() }} </h4>
                        </div>
                    </div>

                    @if (count($categories) != 0)
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category Name</th>
                                        <th>Category Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr class="tr-shadow my-5">
                                            <td>{{ $category->id }}</td>
                                            <td>{{ $category->name }}</td>
                                            <td>{{ $category->created_at->format('j-F-Y') }}</td>
                                            <td>
                                                <div class="table-data-feature">
                                                    {{-- <button class="item" data-toggle="tooltip" data-placement="top"
                                                        title="View">
                                                        <i class="fa-solid fa-eye"></i>
                                                    </button> --}}
                                                    <a href="{{ route('category#edit', $category->id) }}" class="mr-3">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="Edit">
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </button>
                                                    </a>
                                                    <a href="{{ route('category#delete', $category->id) }}" class="mr-3">
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
                                {{ $categories->links() }}
                                {{-- {{ $categories->appends(request()->query())->links() }} --}}
                            </div>

                        </div>
                    @else
                        <h1 class="text-muted text-center m-5">There is no Category Here!Please add...</h1>
                    @endif
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
