@php
    $title = 'My Vacay Host';
    $filename = 'Home Section';
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
                <h4 class="card-title">Create Home Section</h4>

            </div>
            <div class="card-content">
                <div class="card-body">
                    <form class="form form-vertical" action="{{ route('home-section.save') }}" method="post"
                        enctype="multipart/form-data" id="createDrawHomeDestination">
                        @csrf
                        <div class="form-body">
                            <div class="row">

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="heading-vertical">Title</label>
                                        <input type="text" id="heading-vertical"
                                            class="form-control @error('title') is-invalid @enderror" name="title"
                                            placeholder="title" value="{{ old('title', $info->title ?? '') }}" required
                                            data-validation-required-message="This title field is required">
                                    </div>
                                    @error('title')
                                        <span class="text-danger" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="sub-heading-vertical">Sub Title</label>
                                        <input type="text" id="sub-heading-vertical"
                                            class="form-control @error('subtitle') is-invalid @enderror" name="subtitle"
                                            placeholder="Heading" value="{{ old('subtitle', $info->subtitle ?? '') }}"
                                            required data-validation-required-message="This sub title field is required">
                                    </div>
                                    @error('subtitle')
                                        <span class="text-danger" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="sub-heading-vertical">Video</label>
                                        <input type="file" id="sub-heading-vertical"
                                            class="form-control @error('image') is-invalid @enderror" name="image"
                                            placeholder="Heading" value="{{ old('image', $info->image ?? '') }}">
                                    </div>
                                    @error('image')
                                        <span class="text-danger" role="alert">{{ $message }}</span>
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
            $('#createDrawHomeDestination').validate({ // initialize the plugin
                rules: {
                    title: {
                        required: true,
                    },
                    subtitle: {
                        required: true
                    },
                },
                // Customizing error messages
                messages: {
                    title: {
                        required: "This title field is required."
                    },
                    subtitle: {
                        required: "This subtitle field is required."
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
