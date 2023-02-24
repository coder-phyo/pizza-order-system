@extends('admin.layouts.master')

@section('title', 'Users List Page')

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
                        <div class="col-2 bg-white shadow-sm text-center py-1 rounded">
                            <h4><i class="fa-solid fa-users mr-2"></i>Total-{{ $users->total() }} </h4>
                        </div>
                    </div>

                    @if (count($users) != 0)
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Gender</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>Role</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td class="col-2">
                                                @if ($user->image === null)
                                                    @if ($user->gender === 'male')
                                                        <img src="{{ asset('image/default_user.jpg') }}"
                                                            style="width
                                                :400px"
                                                            class="img-thumbnail shadow-sm">
                                                    @else
                                                        <img src="{{ asset('image/female_default.jfif') }}"
                                                            style="width
                                                :400px;height:100px;"
                                                            class="img-thumbnail shadow-sm">
                                                    @endif
                                                @else
                                                    <img src="{{ asset('storage/' . $user->image) }}"
                                                        style="width
                                                :400px;height:150px;"
                                                        class="shadow-sm img-thumbnail" />
                                                @endif
                                            </td>
                                            <input type="hidden" id="userIdValue" value="{{ $user->id }}">
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->gender }}</td>
                                            <td>{{ $user->phone }}</td>
                                            <td>{{ $user->address }}</td>
                                            <td>
                                                <select class="form-select changeRole">
                                                    <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>
                                                        User
                                                    </option>
                                                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>
                                                        Admin
                                                    </option>
                                                </select>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="mt-3">
                                {{ $users->links() }}
                            </div>

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
            $('.changeRole').change(function() {
                $currentRole = $(this).val();
                $parentNode = $(this).parents("tr");
                $userId = $parentNode.find("#userIdValue").val();

                $data = {
                    id: $userId,
                    role: $currentRole
                }

                console.log($data);

                $.ajax({
                    type: "get",
                    url: "/user/ajax/change/role",
                    data: $data,
                    dataType: "json",
                })

                location.reload();
            })
        })
    </script>
@endsection
