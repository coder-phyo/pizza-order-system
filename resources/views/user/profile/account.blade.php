@extends('user.layouts.master')

@section('title', 'Account Change')

@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">

                <div class="col-sm-12 col-lg-10 offset-lg-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2"> <i class="fa-solid fa-address-book me-2"></i> Account Profile
                                </h3>
                            </div>
                            <hr>

                            @if (session('updateSuccess'))
                                <div class="col-5 offset-5">
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <i class="fa-solid fa-check"></i> {{ session('updateSuccess') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                </div>
                            @endif


                            <form action="{{ route('user#accountChange', Auth::user()->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-4">
                                        @if (Auth::user()->image === null)
                                            @if (Auth::user()->gender === 'male')
                                                <img src="{{ asset('image/default_user.jpg') }}"
                                                    class="img-thumnail shadow-sm">
                                            @else
                                                <img src="{{ asset('image/female_default.jfif') }}"
                                                    class="img-thumnail shadow-sm">
                                            @endif
                                        @else
                                            <img src="{{ asset('storage/' . Auth::user()->image) }}"
                                                class="shadow-sm img-thumbnail" />
                                        @endif

                                        <div class="mt-3" style="width:230px">
                                            <input type="file" name="image"
                                                class="w-100  form-control @error('image') is-invalid @enderror">
                                            @error('image')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                        </div>

                                        <div class="mt-2" style="width:230px">
                                            <button type="submit" class="btn btn-dark text-white w-100"><i
                                                    class="fa-solid fa-pen-fancy me-1"></i>Update</button>
                                        </div>
                                    </div>

                                    <div class="row col-6 offset-1">
                                        <div class="form-group">
                                            <label for="name" class="control-label mb-1">Name</label>
                                            <input id="name" name="name" type="text"
                                                class="form-control  @error('name') is-invalid @enderror"
                                                value="{{ old('name', Auth::user()->name) }}" aria-required="true"
                                                aria-invalid="false" placeholder="Enter Admin Name...">
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="email" class="control-label mb-1">Email</label>
                                            <input id="email" name="email" type="text"
                                                class="form-control  @error('email') is-invalid @enderror"
                                                value="{{ old('email', Auth::user()->email) }}" aria-required="true"
                                                aria-invalid="false" placeholder="Enter Admin Email...">
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="phone" class="control-label mb-1">Phone</label>
                                            <input id="phone" name="phone" type="text"
                                                class="form-control  @error('phone') is-invalid @enderror"
                                                value="{{ old('phone', Auth::user()->phone) }}" aria-required="true"
                                                aria-invalid="false" placeholder="Enter Admin Phone...">
                                            @error('phone')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="phone" class="control-label mb-1">Gender</label>
                                            <select name="gender"
                                                class="form-control  @error('gender') is-invalid @enderror">
                                                <option value="">Choose gender</option>
                                                <option value="male" @if (Auth::user()->gender === 'male') selected @endif>
                                                    Male
                                                </option>
                                                <option value="female" @if (Auth::user()->gender === 'female') selected @endif>
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
                                            <textarea id="address" name="address" cols="30" rows="10"
                                                class="form-control  @error('address') is-invalid @enderror" aria-required="true" aria-invalid="false"
                                                placeholder="Enter Admin Address...">{{ old('address', Auth::user()->address) }}</textarea>
                                            @error('address')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="role" class="control-label mb-1">Role</label>
                                            <input id="role" name="role" type="text" class="form-control"
                                                value="{{ old('role', Auth::user()->role) }}" disabled readonly
                                                aria-required="true" aria-invalid="false">
                                        </div>
                                    </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
