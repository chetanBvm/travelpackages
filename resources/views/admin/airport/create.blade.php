@php
    $title = 'My Vacay Host';
    $filename = 'Create Airport';
@endphp
@extends('admin.layouts.app')
@section('title', $title)
@section('filename', $filename)
@section('content')

    <div class="col-md-12 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Create Airport</h4>
                <a href="{{route('airport.index')}}" type="button"
                class="btn btn-info gray-btn d-lg-block m-l-15"><i class="bi bi-caret-left-fill"></i><span>Back</span></a>

            </div>
            <div class="card-content">
                <div class="card-body">
                    <form class="form form-vertical" action="{{ route('airport.store') }}" method="post"
                        enctype="multipart/form-data" id="createDrawBanner">
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Code</label>
                                        <input type="text" id="name-vertical" class="form-control" name="code"
                                            placeholder="Enter Code eg:AW">
                                    </div>
                                    @error('code')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Name</label>
                                        <input type="text" id="name-vertical" class="form-control" name="name"
                                            placeholder="Enter Name">
                                    </div>
                                    @error('name')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="text-vertical">City</label>
                                        <input type="text" id="text-vertical" class="form-control" name="city"
                                            placeholder="Enter city">
                                    </div>
                                    @error('city')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div>
                                                              
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="text-vertical">Country Name</label>
                                        <input type="text" id="text-vertical" class="form-control" name="country_name"
                                            placeholder="Enter country name">
                                    </div>
                                    @error('country_name')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                    <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
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
            $('#createDrawBanner').validate({ // initialize the plugin
                rules: {
                    name: {
                        required: true
                    },
                    city:{
                        required:true
                    },
                    code:{
                        required:true
                    },
                    country_name: {
                        required: true
                    },
                },
                // Customizing error messages
                messages: {
                    name: {
                        required: "Please enter the name of the airport."
                    },
                    city:{
                        required: "Please enter the city"
                    },
                    code:{
                        required: "Please enter the code"
                    },
                    country_name: {
                        required: "Please enter the country name"
                    },
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
