@extends('admin.layouts.master')

@section('title', 'Update Pizza')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">

                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="ms-5">
                                <i class="fa-solid fa-arrow-left-long text-dark" onclick="history.back()"></i>
                            </div>
                            <div class="card-title">
                                <h3 class="text-center title-2"> <i class="fa-solid fa-address-book me-2"></i> Update Pizza
                                </h3>
                            </div>
                            <hr>


                            <form action="{{ route('products#update') }}" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="pizzaId" value="{{ $pizza->id }}">
                                @csrf
                                <div class="row">
                                    <div class="col-5">
                                        <img src="{{ asset('storage/' . $pizza->image) }}"
                                            class="shadow-sm img-thumbnail" />

                                        <div class="mt-3" style="width:230px">
                                            <input type="file" name="pizzaImage"
                                                class="w-100  form-control @error('pizzaImage') is-invalid @enderror">
                                            @error('pizzaImage')
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

                                    <div class="row col-6">
                                        <div class="form-group">
                                            <label for="pizzaName" class="control-label mb-1">Name</label>
                                            <input id="pizzaName" name="pizzaName" type="text"
                                                class="form-control  @error('pizzaName') is-invalid @enderror"
                                                value="{{ old('pizzaName', $pizza->name) }}" aria-required="true"
                                                aria-invalid="false" placeholder="Enter Pizza Name...">
                                            @error('pizzaName')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="pizzaDescription" class="control-label mb-1">Description</label>
                                            <textarea id="pizzaDescription" name="pizzaDescription" cols="30" rows="10"
                                                class="form-control  @error('pizzaDescription') is-invalid @enderror" aria-required="true" aria-invalid="false"
                                                placeholder="Enter description...">{{ old('pizzaDescription', $pizza->description) }}</textarea>
                                            @error('pizzaDescription')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="phone" class="control-label mb-1">Category</label>
                                            <select name="pizzaCategory"
                                                class="form-control  @error('pizzaCategory') is-invalid @enderror">
                                                <option value="">Choose category</option>
                                                @foreach ($category as $c)
                                                    <option value="{{ $c->id }}"
                                                        {{ $c->id == $pizza->category_id ? 'selected' : '' }}>
                                                        {{ $c->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('pizzaCategory')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="pizzaPrice" class="control-label mb-1">Price</label>
                                            <input id="pizzaPrice" name="pizzaPrice" type="number"
                                                class="form-control  @error('pizzaPrice') is-invalid @enderror"
                                                value="{{ old('pizzaPrice', $pizza->price) }}" aria-required="true"
                                                aria-invalid="false" placeholder="Enter Pizza price...">
                                            @error('pizzaPrice')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="pizzaWaitingTime" class="control-label mb-1">Waiting Time</label>
                                            <input id="pizzaWaitingTime" name="pizzaWaitingTime" type="number"
                                                class="form-control  @error('pizzaWaitingTime') is-invalid @enderror"
                                                value="{{ old('pizzaWaitingTime', $pizza->waiting_time) }}"
                                                aria-required="true" aria-invalid="false"
                                                placeholder="Enter Waiting Time...">
                                            @error('pizzaWaitingTime')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="viewCount" class="control-label mb-1">View Count</label>
                                            <input id="viewCount" name="viewCount" type="number"
                                                class="form-control  @error('viewCount') is-invalid @enderror"
                                                value="{{ old('viewCount', $pizza->view_count) }}" aria-required="true"
                                                disabled readonly aria-invalid="false">
                                        </div>

                                        <div class="form-group">
                                            <label for="created_at" class="control-label mb-1">Created Time</label>
                                            <input id="created_at" name="created_at" type="text" class="form-control"
                                                value="{{ old('created_at', $pizza->created_at->format('j-F-Y')) }}"
                                                disabled readonly aria-required="true" aria-invalid="false">
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
