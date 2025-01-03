@extends('layouts.app')
@section('content')
    <div class="main">
        <!-- College-Banner -->
        <section class="college">
            <div class="container-fluid">
                <div class="college-inner">
                    <figure>
                        <img src="{{ asset('web/assets/images/contact-bg.png') }}">
                    </figure>
                    <div class="college-content">
                        @if (isset($contactUs))
                            <h1>{{ $contactUs->title }}</h1>
                            <p>{{ $contactUs->subtitle }}</p>
                        @else
                            <h1>Contact Us</h1>
                            <p>Come See the world with Us</p>
                        @endif
                    </div>
                </div>
            </div>
        </section>
        <!-- Contact -->
        <section class="contact">
            <div class="container">

                @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif
                @if (session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session()->get('error') }}
                    </div>
                @endif
                <div class="contact-inner">
                    <form class="contact-form" action="{{ route('contactus.save') }}" method="post">
                        @csrf()
                        <div class="row">
                            <div class="col-sm-6 col-md-6">
                                <div class="contact-content">
                                    <label>First Name </label>
                                    <input type="text" name="f_name"
                                        class="form-control @error('f_name') is-invalid @enderror"
                                        placeholder="Enter First Name" value="{{ old('f_name') }}">
                                    @error('f_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="contact-content">
                                    <label>Last Name</label>
                                    <input type="text" name="l_name"
                                        class="form-control @error('l_name') is-invalid @enderror"
                                        placeholder="Enter Last Name" value="{{ old('l_name') }}">
                                    @error('l_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-6">
                                <div class="contact-content">
                                    <label>Email Address</label>
                                    <input type="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        placeholder="Enter email address" value="{{ old('email') }}">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="contact-content">
                                    <label>Phone Number</label>
                                    <div class="mobile-number-inner">
                                        <input name="mobile_number" type="tel" id="phone"
                                            class="form-control @error('mobile_number') is-invalid @enderror"
                                            placeholder="Enter 10 digit phone number" value="{{ old('mobile_number') }}"
                                            maxlength="11" pattern="[0-9\s]+">
                                       
                                    </div>
                                    @error('mobile_number')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="contact-content">
                                    <label>Message</label>
                                    <textarea placeholder="Message" name="message" class="form-control @error('message') is-invalid @enderror">{{ old('message') }}</textarea>
                                    @error('message')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button class="travel-btn" type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </section>
        <!-- Contact-slider -->
        <section class="con-slider">
            <div class="container-fluid">
                <div class="con-inner">
                    <div class="owl-carousel owl-theme contact-slider">
                        @php
                            $images = json_decode($contactUs->image, true);
                        @endphp
                        @foreach ($images as $image)
                            <div class="item">
                                <figure>
                                    <img src="{{ asset('storage' . '/' . $image) }}">
                                </figure>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </div>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/css/intlTelInput.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/js/intlTelInput.min.js"></script>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const phoneInput = document.querySelector("#phone");

            const iti = window.intlTelInput(phoneInput, {
                initialCountry: "in", // Set default country (e.g., India)
                preferredCountries: ["in", "us", "gb"], // Set preferred countries
                separateDialCode: true, // Show country code separately
                utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/js/utils.js", // Load utility scripts for formatting
            });
        });
    </script>
@endsection
