@php
    $title = 'My Vacay Host';
    $filename = 'Contact';
@endphp
@extends('admin.layouts.app')
@section('title', $title)
@section('filename', $filename)
@section('content')

    <div class="col-md-12 col-12">
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
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Create Contact</h4>

            </div>
            <div class="card-content">
                <div class="card-body">
                    <form class="form form-vertical" action="{{ route('contact.save') }}" method="post"
                        enctype="multipart/form-data" id="createDrawHomeStay">
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="heading-vertical">Email<span class="text-danger">*</span></label>
                                        <input type="text" id="heading-vertical"
                                            class="form-control" name="email"
                                            placeholder="email" value="{{ old('email', $contact->email ?? '') }}" maxlength="30">
                                    </div>
                                    @error('email')
                                        <span class="text-danger" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="heading-vertical">Mobile Number<span class="text-danger">*</span></label>
                                        <input type="text" id="heading-vertical"
                                            class="form-control" name="mobile_number"
                                            placeholder="mobile number" value="{{ old('mobile_number', $contact->mobile_number ?? '') }}" maxlength="12" pattern="[0-9\s]+" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                    </div>
                                    @error('mobile_number')
                                        <span class="text-danger" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="heading-vertical">Toll Free Number<span class="text-danger">*</span></label>
                                        <input type="text" id="heading-vertical"
                                            class="form-control" name="toll_number"
                                            placeholder="Toll number" value="{{ old('toll_number', $contact->toll_number ?? '') }}" maxlength="12" pattern="[0-9\s]+" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                    </div>
                                    @error('toll_number')
                                        <span class="text-danger" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="heading-vertical">Location<span class="text-danger">*</span></label>
                                        <input type="text" id="heading-vertical"
                                            class="form-control" name="address"
                                            placeholder="address" value="{{ old('address', $contact->address ?? '') }}" maxlength="15" pattern="[A-Za-z\s]+" oninput="this.value = this.value.replace(/[^A-Za-z]/g, '')">
                                    </div>
                                    @error('address')
                                        <span class="text-danger" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>                      
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script>
        //Validation script
        $(document).ready(function() {
            $('#createDrawHomeStay').validate({ // initialize the plugin
                rules: {
                    email: {
                        required: true,
                    },
                    address:{
                        required:true,
                    },
                    toll_number :{
                        required:true,
                    },
                    mobile_number:{
                        required:true,
                    }
                },
                // Customizing error messages
                messages: {
                    email: {
                        required: "The email field is required."
                    },
                    address:{
                        required:"The address field is required.",
                    },
                    toll_number :{
                        required: "The toll number field is required.",
                    },
                    mobile_number:{
                        required: "The mobile number field is required.",
                    }
                },
                errorPlacement: function(error, element) {
                    var placement = $(element).data('error');
                    if (placement) {
                        $(placement).append(error)
                    } else {
                        error.addClass('text-danger')
                            .insertAfter(element);
                    }
                },
                errorClass: 'invalid', // Assign a custom class to the error message
                validClass: 'valid' // Optionally, define a class for valid inputs
            });
        });
    </script>
@endsection
