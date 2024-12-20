@php
    $title = 'My Vacay Host';
    $filename = 'Home Travel Experience';
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
                <h4 class="card-title">Create Home Top Bar</h4>

            </div>
            <div class="card-content">
                <div class="card-body">
                    <form class="form form-vertical" action="{{ route('home-topbar.save') }}" method="post"
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
                                        <label for="sub-heading-vertical">Title Coupon Banner</label>
                                        <input type="text" id="sub-heading-vertical"
                                            class="form-control @error('header_title') is-invalid @enderror" name="header_title"
                                            placeholder="Eg:BLACK FRIDAY AT My Vacay Host: Additional $100 OFF" value="{{ old('header_title', $info->header_title ?? '') }}"
                                            required>
                                    </div>
                                    @error('header_title')
                                        <span class="text-danger" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Social Links Section -->
                                {{-- <div class="col-6"></div> --}}
                                <div class="col-6">
                                <div class="form-group">
                                    <label>Social Links</label>
                                    <div id="social-links-container">
                                        @if (!empty($socialLinks))
                                        @foreach ($socialLinks as $index => $link)
                                            <div class="social-link-item mb-2">
                                                <input type="url" name="social_link[{{ $index }}][url]" 
                                                       class="form-control" 
                                                       value="{{ $link['url'] }}" 
                                                       placeholder="URL (e.g., https://facebook.com)" required>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="social-link-item">
                                            <input type="url" name="social_link[0][url]" class="form-control mb-2"
                                                placeholder="URL (e.g., https://facebook.com)" required>
                                        </div>
                                        @endif
                                    </div>
                                    <button type="button" id="add-link" class="btn btn-primary mt-2">Add Another
                                        Link</button>
                                    @error('social_link')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
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
            $('#createDrawHomeDestination').validate({ // initialize the plugin
                rules: {
                    title: {
                        required: true,
                    },                   
                },
                // Customizing error messages
                messages: {
                    title: {
                        required: "This title field is required."
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
    <script>
        let linkCount = 1;
        document.getElementById('add-link').addEventListener('click', function() {
            const container = document.getElementById('social-links-container');
            const newLink = `
                <div class="social-link-item">                    
                    <input type="url" name="social_link[${linkCount}][url]" class="form-control mb-2" value="" placeholder="URL (e.g., https://twitter.com)" required>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', newLink);
            linkCount++;
        });
    </script>
@endsection
