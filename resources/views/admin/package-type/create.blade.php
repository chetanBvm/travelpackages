@php
    $title = 'My Vacay Host';
    $filename = 'Create Package Type';
@endphp
@extends('admin.layouts.app')
@section('title', $title)
@section('filename', $filename)
@section('content')

    <div class="col-md-12 col-12">
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        @if (session()->has('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Create Package Type</h4>
                <a href="{{ route('package-type.index') }}" type="button" class="btn btn-info gray-btn d-lg-block m-l-15"><i
                        class="bi bi-caret-left-fill"></i><span>Back</span></a>

            </div>
            <div class="card-content">
                <div class="card-body">
                    <form class="form form-vertical" action="{{ route('package-type.store') }}" method="post"
                        enctype="multipart/form-data" id="createDrawPackages">
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Name</label>
                                        <input type="text" id="first-name-vertical" class="form-control" name="name"
                                            placeholder="Name" value="{{old('name')}}">
                                    </div>
                                    @error('name')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="days">Status</label>
                                        <select class="form-select" id="basicSelect" name="status">
                                            <option value="Active">Active</option>
                                            <option value="InActive">InActive</option>
                                        </select>
                                    </div>
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
            $('#createDrawPackages').validate({ // initialize the plugin
                rules: {

                    name: {
                        required: true
                    },
                    status: {
                        required: true
                    },
                },
                // Customizing error messages
                messages: {

                    name: {
                        required: "Please enter the name of the package."
                    },
                    status: {
                        required: "Please select the status."
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
