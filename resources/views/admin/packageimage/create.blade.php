@php
    $title = 'My Vacay Host';
    $filename = 'Create Package Images';
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
                <h4 class="card-title">Packages Images</h4>
                <a href="{{route('package-image.index')}}" type="button"
                class="btn btn-info gray-btn d-lg-block m-l-15"><i class="bi bi-caret-left-fill"></i><span>Back</span></a>

            </div>
            <div class="card-content">
                <div class="card-body">
                    <form class="form form-vertical" action="{{ route('package-image.store') }}" method="post"
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
                                    @error('package_id')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="package-vertical">Images</label>
                                        <input type="file" class="form-control" name="images[]" id="imageInput"
                                            accept="image/jpeg, image/png, image/gif, image/jpg" onchange="previewImages(event)" multiple>
                                    </div>
                                    @error('images')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div>
                                <div id="imagePreviews" style="display: flex; flex-wrap: wrap;">
                                    @if(isset($packageData) && $packageData->images)
                                    @php
                                        $images = json_decode($packageData->images);
                                    @endphp
                                    @foreach ($images as $image)
                                        <img src="{{ asset('storage/' . $image) }}" alt="image" style="width: 150px; margin: 10px; border: 2px solid #ccc;">
                                    @endforeach
                                @endif
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
                    package_id: {
                        required: true,
                    },
                    images: {
                        required: true
                    },

                },
                // Customizing error messages
                messages: {
                    package_id: {
                        required: "Please select the package."
                    },
                    images: {
                        required: "Please choose the 1 and more image."
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
        // Preview selected images
        function previewImages(event) {
            const previewContainer = document.getElementById('imagePreviews');
            previewContainer.innerHTML = ''; // Clear previous previews

            const files = event.target.files;

            // Loop through the files and create a preview for each
            for (let i = 0; i < files.length; i++) {
                const file = files[i];

                const reader = new FileReader();
                reader.onload = function(e) {
                    const imgElement = document.createElement('img');
                    imgElement.src = e.target.result;
                    imgElement.style.width = '150px';
                    imgElement.style.margin = '10px';
                    imgElement.style.border = '2px solid #ccc';

                    previewContainer.appendChild(imgElement);
                };

                if (file) {
                    reader.readAsDataURL(file);
                }
            }
        }
    </script>
@endsection
