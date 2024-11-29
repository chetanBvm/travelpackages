@php
    $title = 'My Vacay Host';
    $filename = 'Create Destination';
@endphp
@extends('admin.layouts.app')
@section('title', $title)
@section('filename', $filename)
@section('content')

    <div class="col-md-12 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Create destination</h4>
                <a href="#" type="button"
                class="btn btn-info gray-btn d-lg-block m-l-15"><i class="bi bi-caret-left-fill"></i><span>Back</span></a>

            </div>
            <div class="card-content">
                <div class="card-body">
                    <form class="form form-vertical" action="{{ route('destination.store') }}" method="post"
                        enctype="multipart/form-data" id="createDrawDestination">
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Country Name</label>
                                        <select class="form-select" id="basicSelect" name="countries_id">
                                            @foreach ($country as $countries)
                                                <option value="{{ $countries->id }}">{{ $countries->name }}</option>
                                            @endforeach
                                        </select>

                                        {{-- <input type="text" id="name-vertical" class="form-control" name="name"
                                            placeholder="Name"> --}}
                                    </div>
                                    @error('countries_id')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="days">Type</label>
                                        <input type="text" id="type" class="form-control" name="type"
                                            placeholder="type">
                                    </div>
                                    @error('type')
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

                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="image" for="">Image</label>
                                        <input type="file" name="image" class="form-control" id="image"
                                            accept="image/jpeg, image/png, image/gif, image/jpg">
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
            $('#createDrawDestination').validate({ // initialize the plugin
                rules: {
                    countries_id: {
                        required: true
                    },
                    type: {
                        required: true
                    },
                    status: {
                        required: true
                    },
                },
                // Customizing error messages
                messages: {
                    countries_id: {
                        required: "Please select the country name of the destination."
                    },
                    type: {
                        required: "Please enter the type."
                    },
                    status: {
                        required: "Please select the status."
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
