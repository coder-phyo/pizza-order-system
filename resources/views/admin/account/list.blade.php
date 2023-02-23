@extends('admin.layouts.master')

@section('title', 'Admin List Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->

                    @if (session('createSuccess'))
                        <div class="col-5 offset-7">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-check"></i> {{ session('createSuccess') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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
                            <form action="{{ route('admin#list') }}" method="get" class="form-group">
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
                            <h4><i class="fa-solid fa-clipboard-list me-2"></i>{{ $admin->total() }}</h4>
                        </div>
                    </div>

                    {{-- @if (count($categories) != 0) --}}
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Gender</th>
                                    <th>Address</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($admin as $a)
                                    <tr class="tr-shadow my-5">
                                        <td class="col-2 ">
                                            @if ($a->image === null)
                                                @if ($a->gender === 'male')
                                                    <img src="{{ asset('image/default_user.jpg') }}"
                                                        class="img-thumnail shadow-sm">
                                                @else
                                                    <img src="{{ asset('image/female_default.jfif') }}"
                                                        class="img-thumnail shadow-sm">
                                                @endif
                                            @else
                                                <img src="{{ asset('storage/' . $a->image) }}"
                                                    class="img-thumnail shadow-sm">
                                            @endif
                                        </td>
                                        <input type="hidden" class="userId" value="{{ $a->id }}">
                                        <td class="">{{ $a->name }}</td>
                                        <td class="">{{ $a->email }}</td>
                                        <td class="">{{ $a->phone }}</td>
                                        <td class="">{{ $a->gender }}</td>
                                        <td class="">{{ $a->address }}</td>
                                        <td>
                                            <div class="table-data-feature ms-3">
                                                @if (Auth::user()->id != $a->id)
                                                    <select name="status" class="form-select changeRole me-3">
                                                        <option value="admin"
                                                            @if ($a->role === 'admin') selected @endif>
                                                            Admin</option>
                                                        <option value="user"
                                                            @if ($a->role === 'user') selected @endif>
                                                            User</option>

                                                    </select>
                                                    <a href="{{ route('admin#changeRole', $a->id) }}" class="me-1">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="Change Role">
                                                            <i class="fa-solid fa-person-circle-minus"></i>

                                                        </button>
                                                    </a>
                                                    <a href="{{ route('admin#delete', $a->id) }}" class="me-1">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="Delete">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>

                        <div class="mt-3">
                            {{ $admin->links() }}
                            {{-- {{ $categories->appends(request()->query())->links() }} --}}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection

@section('scriptSection')
    <script>
        $(document).ready(function() {
            $('.changeRole').change(function() {
                $role = $(this).val();
                $parentNode = $(this).parents('tr');
                $userId = $parentNode.find('.userId').val();

                $data = {
                    userId: $userId,
                    role: $role
                };

                $.ajax({
                    type: "get",
                    url: "http://127.0.0.1:8000/admin/ajax/change/role",
                    data: $data,
                    dataType: "json",
                })

                location.reload();
            })
        })
    </script>
@endsection
