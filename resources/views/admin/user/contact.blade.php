@extends('admin.layouts.master')

@section('title', 'Contact List Page')

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
                                <h2 class="title-1">Content List</h2>

                            </div>
                        </div>

                    </div>

                    @if (session('deleteSuccess'))
                        <div class="col-5 offset-7">
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-circle-xmark"></i> {{ session('deleteSuccess') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    <div class="row mt-2">
                        <div class="col-1 offset-10 bg-white shadow-sm text-center py-1 rounded">
                            <h4><i class="fa-solid fa-message me-2"></i>{{ $contacts->total() }}</h4>
                        </div>
                    </div>

                    @if (count($contacts) != 0)
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2">
                                <thead>
                                    <tr>

                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Message</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($contacts as $c)
                                        <tr class="tr-shadow my-5">
                                            <td>{{ $c->name }}</td>
                                            <td>{{ $c->email }}</td>
                                            <td>{{ Str::words($c->message, 10, '...') }}</td>
                                            <td>
                                                <div class="table-data-feature ms-3">
                                                    <a href="{{ route('admin#contactDetails', $c->id) }}">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="View">
                                                            <i class="fa-solid fa-eye"></i>
                                                        </button>
                                                    </a>
                                                    <a href="{{ route('admin#deleteContact', $c->id) }}" class="ms-3">
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
                                {{ $contacts->links() }}
                            </div>
                        </div>
                    @else
                        <h1 class="text-muted text-center m-5">There is no Contacts Here!</h1>
                    @endif
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
