@php
    $title = 'My Vacay Host';
    $filename = 'Edit Destination';
@endphp
@extends('admin.layouts.app')
@section('title', $title)
@section('filename', $filename)
@section('content')

    <div class="col-md-12 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit Packages</h4>              

            </div>
            <div class="card-content">
                <div class="card-body">
                    <form class="form form-vertical" action="{{ route('package-review.update', $packageReview->id) }}"
                        method="post" enctype="multipart/form-data" id="createDrawDestination">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="form-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="days">Package<span class="text-danger">*</span></label>
                                        <select class="form-select" id="basicSelect" name="package_id">
                                            @foreach ($package as $value)
                                                <option value="{{ $value->id }}"
                                                    {{ $value->id == $packageReview->package_id ? 'selected' : '' }}>
                                                    {{ $value->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Name<span class="text-danger">*</span></label>
                                        <input type="text" id="name-vertical" class="form-control" maxlength="30" name="name"
                                            value="{{ $packageReview->name }}" placeholder="Name">
                                    </div>
                                    @error('name')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="days">Status<span class="text-danger">*</span></label>
                                        <select class="form-select" id="basicSelect" name="status">
                                            <option value="{{ $packageReview->status }}">{{ $packageReview->status }}
                                            </option>
                                            <option value="Active">Active</option>
                                            <option value="InActive">InActive</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="image" for="">Image<span class="text-danger">*</span></label>
                                       
                                        <input type="file" class="form-control" name="images" id="image">
                                    </div>
                                    <div>
                                         <!-- Display the existing image if available -->
                                         @if ($packageReview->images)
                                         <div>
                                             <img id="imagePreview"
                                                 src="{{ asset('storage/' . $packageReview->images) }}"
                                                 alt="Current Image" width="100" height="100">
                                         </div>
                                     @endif
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="">Description<span class="text-danger">*</span></label>
                                        <textarea name="description" id="default" cols="30" rows="10">{{ old('description', strip_tags($packageReview->description) ?? '') }}</textarea>
                                    </div>
                                    @error('description')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                    <a href="{{ route('package-review.index') }}" type="button"
                                        class="btn btn-light-secondary me-1 mb-1"><span>Back</span></a>
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

    <script src="{{ asset('admin/assets/vendors/ckeditor/ckeditor.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

    <script>
       ClassicEditor
            .create(document.querySelector('#default'))
            .catch(error => {
                console.error(error);
            });

        //preview Image
        function previewImage() {
            const file = document.getElementById('image').files[0];
            const reader = new FileReader();

            reader.onloadend = function() {
                document.getElementById('imagePreview').src = reader.result;
            }

            if (file) {
                reader.readAsDataURL(file); // This will trigger the onloadend event
            } else {
                document.getElementById('imagePreview').src = "#"; // Reset the preview if no file is selected
            }
        }
        $("#image").change(function() {
            previewImage(this);
        });

        //Validation script
        $(document).ready(function() {
            $('#createDrawDestination').validate({ // initialize the plugin
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
                        required: "Please enter the name of the package."
                    },
                    description: {
                        required: "Please provide a description."
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
