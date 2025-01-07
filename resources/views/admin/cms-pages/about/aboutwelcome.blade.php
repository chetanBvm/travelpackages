@php
    $title = 'My Vacay Host';
    $filename = 'About Welcome';
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
                <h4 class="card-title">Create About Welcome</h4>

            </div>
            <div class="card-content">
                <div class="card-body">
                    <form class="form form-vertical" action="{{ route('aboutwelcome.save') }}" method="post"
                        enctype="multipart/form-data" id="createDrawHomeDestination">
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="heading-vertical">Title<span class="text-danger">*</span></label>
                                        <input type="text" id="heading-vertical"
                                            class="form-control @error('title') is-invalid @enderror" name="title"
                                            placeholder="title" value="{{ old('title', $info->title ?? '') }}" required
                                            data-validation-required-message="This title field is required">
                                    </div>
                                    @error('title')
                                        <span class="text-danger" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="sub-heading-vertical">Sub Title<span
                                                class="text-danger">*</span></label>
                                        <textarea name="description" id="default" cols="30" rows="10" placeholder="Enter description">{{ old('description', $info->description ?? '') }}</textarea>
                                    </div>
                                    @error('description')
                                        <span class="text-danger" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Image<span class="text-danger">*</span></label>
                                        <input type="file" id="main_image" name="image[]"
                                            class="form-control file-input @error('image') is-invalid @enderror"
                                            value="{{ old('image') }}" multiple>
                                        @error('image')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div id="error-message" style="color: red; display: none;"></div>
                                <input type="hidden" id="image_paths" name="image_paths" value="{{ json_encode($info->image) }}">

                                <div class="mt-3 imagePreview">
                                    @if ($info && isset($info->image))
                                        @php
                                            $images = json_decode($info->image, true);
                                        @endphp
                                        @if ($images && is_array($images))
                                            @foreach ($images as $index => $image)
                                                <img class="profile-image" src="{{ asset('storage/' . $image['path']) }}"
                                                    alt="your image" width="100px" height="auto"
                                                    style="margin-right: 10px;" />
                                                <button type="button" class="remove-image"
                                                    data-index="{{ $index }}"
                                                    style="background: red; color: white; border: none; border-radius: 50%; width: 20px; height: 20px; cursor: pointer;">&times;</button>
                                            @endforeach
                                        @endif
                                    @else
                                        <p class="text-muted">No images Uploded yet</p>
                                    @endif
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
    <script src="{{ asset('admin/assets/vendors/ckeditor/ckeditor.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> --}}

    <script>
        ClassicEditor
            .create(document.querySelector('#default'))
            .catch(error => {
                console.error(error);
            });

        $(function() {

            var imagesPreview = function(input, placeToInsertImagePreview) {

                if (input.files) {
                    var filesAmount = input.files.length;

                    for (i = 0; i < filesAmount; i++) {
                        var reader = new FileReader();

                        reader.onload = function(event) {
                            $($.parseHTML(
                                '<img class="profile-image" width="100px" height="auto" style="margin-right: 10px;">'
                                )).attr('src', event.target.result).appendTo(
                                placeToInsertImagePreview);
                        }
                        reader.readAsDataURL(input.files[i]);
                    }
                }
            };

            $('#main_image').on('change', function() {
                imagesPreview(this, 'div.imagePreview');
            });
        });

        $(document).ready(function() {
            var maxImages = 3;

            $('#main_image').on('change', function(event) {
                const selectedFiles = event.target.files;

                if (selectedFiles.length > maxImages) {
                    // Show error message
                    $('#error-message').text(`You can only select up to ${maxImages} images.`).show();

                    // Clear the file input so the user can try again
                    $(this).val('');
                } else {
                    // Hide error message
                    $('#error-message').hide();
                    console.log('Selected images:', selectedFiles);
                }
            });
        });

        $('.remove-image').click(function(){
            $(this).parent().remove();            
            
        });
        


        //Validation script
        $(document).ready(function() {
            $('#createDrawHomeDestination').validate({ // initialize the plugin
                rules: {
                    title: {
                        required: true,
                    },
                    description: {
                        required: true
                    },
                },
                // Customizing error messages
                messages: {
                    title: {
                        required: "This title field is required."
                    },
                    description: {
                        required: "This description is required."
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
