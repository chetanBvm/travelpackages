@php
    $title = 'My Vacay Host';
    $filename = 'Create Banner';
@endphp
@extends('admin.layouts.app')
@section('title', $title)
@section('filename', $filename)
@section('content')

    <div class="col-md-12 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Create Banner</h4>
                {{-- <a href="{{ route('banner.index') }}" type="button" class="btn btn-info gray-btn d-lg-block m-l-15"><i
                        class="bi bi-caret-left-fill"></i><span>Back</span></a> --}}

            </div>
            <div class="card-content">
                <div class="card-body">
                    <form class="form form-vertical" action="{{ route('banner.store') }}" method="post"
                        enctype="multipart/form-data" id="createDrawBanner">
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Name</label>
                                        <input type="text" id="name-vertical" class="form-control" name="name"
                                            placeholder="Name">
                                    </div>
                                    @error('name')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="text-vertical">Text</label>
                                        <input type="text" id="text-vertical" class="form-control" name="text"
                                            placeholder="text">
                                    </div>
                                    @error('text')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="text-vertical">Type</label>
                                        <select class="form-select" id="basicSelect" name="type">
                                            <option value="Home">Home</option>
                                            <option value="About">About</option>
                                            <option value="Packages">Packages</option>
                                        </select>
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
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="image" for="">Image</label>
                                        <input type="file" class="form-control" name="image" id="image">
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                    <a href="{{ route('banner.index') }}" type="button"
                                        class="btn btn-light-secondary me-1 mb-1"><span>Back</span></a>

                                    {{-- <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button> --}}
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
    <script src="{{ asset('admin/assets/vendors/tinymce/tinymce.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

    <script>
        tinymce.init({
            selector: '#default'
        });
        tinymce.init({
            selector: '#dark',
            toolbar: 'undo redo styleselect bold italic alignleft aligncenter alignright bullist numlist outdent indent code',
            plugins: 'code'
        });

        //Validation script
        $(document).ready(function() {
            $('#createDrawBanner').validate({ // initialize the plugin
                rules: {
                    name: {
                        required: true
                    },
                    text: {
                        required: true
                    },
                    type: {
                        required: true
                    },
                    image: {
                        required: true
                    },
                    status: {
                        required: true
                    },
                },
                // Customizing error messages
                messages: {
                    name: {
                        required: "Please enter the name of the."
                    },
                    text: {
                        required: "Please enter the text of the banner"
                    },
                    type: {
                        required: "Please enter the type of the banner"
                    },
                    image: {
                        required: "Please choose the image."
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
