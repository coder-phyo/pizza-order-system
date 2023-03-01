@extends('user.layouts.master')

@section('title', 'Contact')

@section('content')
    <!-- Contact Start -->
    <div class="container-fluid">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Contact
                Us</span></h2>

        @if (session('createSuccess'))
            <div class="col-4 offset-6 mb-3">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa-solid fa-check"></i> {{ session('createSuccess') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

        <div class="row px-xl-5">
            <div class="col-lg-7 offset-lg-3 mb-5">
                <div class="contact-form bg-light p-30">
                    <div id="success"></div>
                    <form action="{{ route('contact#create') }}" name="sentMessage" id="contactForm" novalidate="novalidate"
                        method="POST">
                        @csrf
                        <div class="control-group mb-3">
                            <input type="text" class="form-control @error('userName') is-invalid @enderror"
                                id="name" placeholder="Your Name" name="userName" required="required"
                                data-validation-required-message="Please enter your name" />
                            @error('userName')
                                <p class="help-block text-danger">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div class="control-group mb-3">
                            <input type="email" class="form-control @error('userEmail') is-invalid @enderror"
                                id="email" placeholder="Your Email" name="userEmail" required="required"
                                data-validation-required-message="Please enter your email" />
                            @error('userEmail')
                                <p class="help-block text-danger">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div class="control-group mb-3">
                            <textarea class="form-control @error('userMessage') is-invalid @enderror" rows="8" id="message"
                                placeholder="Message" required="required" name="userMessage"
                                data-validation-required-message="Please enter your message"></textarea>
                            @error('userMessage')
                                <p class="help-block text-danger">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div>
                            <button class="btn btn-primary py-2 px-4" type="submit" id="sendMessageButton">Send
                                Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
@endsection
