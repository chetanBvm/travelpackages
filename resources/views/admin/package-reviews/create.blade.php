@php
    $title = 'My Vacay Host';
    $filename = 'Create Package Reviews';
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
                <h4 class="card-title">Create Package Reviews</h4>
                <a href="{{ route('package-review.index') }}" type="button" class="btn btn-info gray-btn d-lg-block m-l-15"><i
                        class="bi bi-caret-left-fill"></i><span>Back</span></a>

            </div>
            <div class="card-content">
                <div class="card-body">
                    <form class="form form-vertical" action="{{ route('package-review.store') }}" method="post"
                        enctype="multipart/form-data" id="createDrawPackages">
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="package-vertical">Package</label>
                                        <select class="form-select" id="basicSelect" name="package_id">
                                            <option value="">---</option>
                                            @foreach ($package as $value)
                                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('pacakge_id')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div>
                              
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Name</label>
                                        <input type="text" id="first-name-vertical" class="form-control" name="name"
                                            placeholder="Name">
                                    </div>
                                    @error('name')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div>  
                             
                                <div class="col-12">
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
                                        <div>
                                            <img id="imagePreview" class="profile-image"
                                                src="{{ asset('admin/assets/images/faces/1.jpg') }}" alt="your image"
                                                width="100px" height="auto" />
                                        </div>
                                        <label class="image" for="">Image</label>
                                        <input type="file" class="form-control" name="images" id="main_image"
                                            accept="image/jpeg, image/png, image/gif, image/jpg">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="default">Description</label>
                                        <textarea name="description" id="default" cols="30" rows="10"></textarea>
                                    </div>
                                    @error('description')
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

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $("#imagePreview").attr("src", e.target
                        .result); //css("background-image", "url("+e.target.result+")");
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#main_image").change(function() {
            readURL(this);
        });

        //Validation script
        $(document).ready(function() {
            $('#createDrawPackages').validate({ // initialize the plugin
                rules: {
                    package_id: {
                        required: true,
                    },                    
                    name: {
                        required: true
                    },                    
                    description: {
                        required: true
                    },
                    images:{
                        required:true
                    },
                    status: {
                        required: true
                    },                    
                },
                // Customizing error messages
                messages: {
                    package_id: {
                        required: "Please select the package."
                    },
                    name: {
                        required: "Please enter the name."
                    },
                    description: {
                        required: "Please provide a description."
                    },
                    images:{
                        required:"Please select the image."
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
