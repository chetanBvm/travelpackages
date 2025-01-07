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
                <h4 class="card-title">ContactUs Management</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <form class="form form-vertical" action="{{ route('admin.contactus.save') }}" method="post"
                        enctype="multipart/form-data" id="createDrawHomeStay">
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="heading-vertical">Title<span class="text-danger">*</span></label>
                                        <input type="text" id="heading-vertical" class="form-control" name="title"
                                            placeholder="title" value="{{ old('title', $contactus->title ?? '') }}"
                                            maxlength="30">
                                    </div>
                                    @error('title')
                                        <span class="text-danger" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="heading-vertical">SubTitle<span class="text-danger">*</span></label>
                                        <input type="text" id="heading-vertical" class="form-control" name="subtitle"
                                            placeholder="sub title"
                                            value="{{ old('subtitle', $contactus->subtitle ?? '') }}" maxlength="30">
                                    </div>
                                    @error('subtitle')
                                        <span class="text-danger" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="heading-vertical">Banner Image<span class="text-danger">*</span></label>
                                        <input type="file" id="heading-vertical" class="form-control" name="banner_image"
                                            placeholder="banner image"
                                            value="{{ old('banner_image', $contactus->banner_image ?? '') }}"
                                            accept = 'image/jpeg , image/jpg, image/gif, image/png , image/svg' multiple>
                                    </div>
                                    @error('banner_image')
                                        <span class="text-danger" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="heading-vertical">Image<span class="text-danger">*</span></label>
                                        <input type="file" id="main_image" class="form-control" name="image[]"
                                            placeholder="image" value="{{ old('image', $contactus->image ?? '') }}"
                                            accept = 'image/jpeg , image/jpg, image/gif, image/png , image/svg' multiple>
                                    </div>
                                    @error('image')
                                        <span class="text-danger" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mt-3">
                                    @php $images = json_decode($contactus->image, true); @endphp
                                    @if (isset($images))
                                        @foreach ($images as $image)
                                            {{-- $path = $image['path']; --}}
                                            {{-- $isBanner = $image['is_banner']; --}}

                                            @if ($image['is_banner'])
                                                <h3>Banner Image:</h3>
                                                <img src="{{ asset('storage/' . $image['path']) }}" alt='Banner Image'
                                                    style="width:50%;height:auto;">
                                            @else
                                                <h3>Gallery Image</h3>
                                                <img src="{{ asset('storage/' . $image['path']) }}" alt='Gallery Image'
                                                    style="width:50%;height:auto;">
                                            @endif
                                        @endforeach
                                    @else
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#imagePreview')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#main_image").change(function() {
            readURL(this);
        });

        //Validation script
        $(document).ready(function() {
            $('#createDrawHomeStay').validate({ // initialize the plugin
                rules: {
                    title: {
                        required: true,
                    },
                    subtitle: {
                        required: true,
                    },
                },
                // Customizing error messages
                messages: {
                    title: {
                        required: "The title field is required."
                    },
                    subtitle: {
                        required: "The subtitle field is required.",
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
