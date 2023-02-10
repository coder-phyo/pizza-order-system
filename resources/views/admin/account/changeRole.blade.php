@extends('admin.layouts.master')

@section('title', 'Change Role')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">

                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <div class="ms-4">
                                    <a href="{{ route('admin#list') }}" class="fa-solid fa-arrow-left-long text-dark"></a>
                                </div>
                                <h3 class="text-center title-2"> <i class="fa-solid fa-address-book me-2"></i> Change Role
                                </h3>
                            </div>
                            <hr>


                            <form action="{{ route('admin#change', $account->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-4">
                                        @if ($account->image === null)
                                            @if ($account->gender === 'male')
                                                <img src="{{ asset('image/default_user.jpg') }}"
                                                    class="img-thumnail shadow-sm">
                                            @else
                                                <img src="{{ asset('image/female_default.jfif') }}"
                                                    class="img-thumnail shadow-sm">
                                            @endif
                                        @else
                                            <img src="{{ asset('storage/' . $account->image) }}"
                                                class="shadow-sm img-thumbnail" />
                                        @endif

                                        <div class="mt-2" style="width:230px">
                                            <button type="submit" class="btn btn-dark text-white w-100"><i
                                                    class="fa-solid fa-pen-fancy me-1"></i>Change</button>
                                        </div>
                                    </div>

                                    <div class="row col-6 offset-1">
                                        <div class="form-group">
                                            <label for="name" class="control-label mb-1">Name</label>
                                            <input id="name" name="name" type="text" disabled readonly
                                                class="form-control  @error('name') is-invalid @enderror"
                                                value="{{ old('name', $account->name) }}" aria-required="true"
                                                aria-invalid="false" placeholder="Enter Admin Name...">
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="role" class="control-label mb-1">Role</label>
                                            <select name="role" class="form-control">
                                                <option value="admin" @if ($account->role === 'admin') selected @endif>
                                                    Admin</option>
                                                <option value="user" @if ($account->role === 'user') selected @endif>
                                                    User</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="email" class="control-label mb-1">Email</label>
                                            <input id="email" name="email" type="text" disabled readonly
                                                class="form-control  @error('email') is-invalid @enderror"
                                                value="{{ old('email', $account->email) }}" aria-required="true"
                                                aria-invalid="false" placeholder="Enter Admin Email...">
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="phone" class="control-label mb-1">Phone</label>
                                            <input id="phone" name="phone" type="text" disabled readonly
                                                class="form-control  @error('phone') is-invalid @enderror"
                                                value="{{ old('phone', $account->phone) }}" aria-required="true"
                                                aria-invalid="false" placeholder="Enter Admin Phone...">
                                            @error('phone')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="phone" class="control-label mb-1">Gender</label>
                                            <select name="gender" disabled readonly
                                                class="form-control  @error('gender') is-invalid @enderror">
                                                <option value="">Choose gender</option>
                                                <option value="male" @if ($account->gender === 'male') selected @endif>
                                                    Male
                                                </option>
                                                <option value="female" @if ($account->gender === 'female') selected @endif>
                                                    Female</option>
                                            </select>
                                            @error('gender')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="address" class="control-label mb-1">Address</label>
                                            <textarea id="address" name="address" cols="30" rows="10" disabled readonly
                                                class="form-control  @error('address') is-invalid @enderror" aria-required="true" aria-invalid="false"
                                                placeholder="Enter Admin Address...">{{ old('address', $account->address) }}</textarea>
                                            @error('address')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>


                                    </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
