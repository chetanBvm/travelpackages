@php
    $title = 'My Vacay Host';
    $filename = 'Edit Package Images';
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
                    <form class="form form-vertical" action="{{ route('package-image.update', $packageImage->id) }}"
                        method="post" enctype="multipart/form-data" id="createDrawPackages">
                        @csrf
                        {{ method_field('put') }}
                        <div class="form-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="package-vertical">Package</label>
                                        <select class="form-select" id="basicSelect" name="package_id">
                                            @foreach ($package as $value)
                                                <option value="{{ $value->id }}"
                                                    {{ $value->id == $packageImage->package_id ? 'selected' : '' }}>
                                                    {{ $value->name }}</option>
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
                                            accept="image/jpeg, image/png, image/gif, image/jpg"
                                            onchange="previewImages(event)" multiple>
                                    </div>
                                    @error('images')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div>
                                {{-- <div id="imagePreviews" style="display: flex; flex-wrap: wrap;">
                                    @if (isset($packageData) && $packageData->images)
                                        @php
                                            $images = json_decode($packageData->images);
                                        @endphp
                                        @foreach ($images as $image)
                                            <img src="{{ asset('storage/' . $image) }}" alt="image"
                                                style="width: 150px; margin: 10px; border: 2px solid #ccc;">
                                        @endforeach
                                    @endif
                                </div> --}}
                                <div id="imagePreviews" style="display: flex; flex-wrap: wrap;">
                                    @if (isset($packageImage->images) && $packageImage->images)
                                        @php
                                            $images = json_decode($packageImage->images);
                                        @endphp
                                        @foreach ($images as $image)
                                            <div class="image-preview" style="position: relative; margin: 10px;">
                                                <img src="{{ asset('storage/' . $image) }}" alt="image" style="width: 150px; border: 2px solid #ccc;">
                                                <button type="button" class="btn btn-danger btn-sm" style="position: absolute; top: 0; right: 0;" onclick="removeImagePreview(this)">
                                                    &times;
                                                </button>
                                            </div>
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
        // function previewImages(event) {
        //     const previewContainer = document.getElementById('imagePreviews');
        //     previewContainer.innerHTML = ''; // Clear previous previews

        //     const files = event.target.files;

        //     // Loop through the files and create a preview for each
        //     for (let i = 0; i < files.length; i++) {
        //         const file = files[i];

        //         const reader = new FileReader();
        //         reader.onload = function(e) {
        //             const imgElement = document.createElement('img');
        //             imgElement.src = e.target.result;
        //             imgElement.style.width = '150px';
        //             imgElement.style.margin = '10px';
        //             imgElement.style.border = '2px solid #ccc';

        //             previewContainer.appendChild(imgElement);
        //         };

        //         if (file) {
        //             reader.readAsDataURL(file);
        //         }
        //     }
        // }

        // Preview images before upload
function previewImages(event) {
    const previewContainer = document.getElementById('imagePreviews');
    previewContainer.innerHTML = '';  // Clear previous previews

    Array.from(event.target.files).forEach((file) => {
        const reader = new FileReader();
        reader.onload = function(e) {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.style.width = '150px';
            img.style.marginRight = '10px';
            img.style.border = '2px solid #ccc';

            // Create a preview container for each image
            const previewDiv = document.createElement('div');
            previewDiv.style.position = 'relative';
            previewDiv.style.margin = '10px';
            previewDiv.appendChild(img);

            // Create a remove button
            const removeButton = document.createElement('button');
            removeButton.textContent = '×';
            removeButton.classList.add('btn', 'btn-danger', 'btn-sm');
            removeButton.style.position = 'absolute';
            removeButton.style.top = '0';
            removeButton.style.right = '0';
            removeButton.onclick = function() {
                previewContainer.removeChild(previewDiv); // Remove the image preview
            };

            previewDiv.appendChild(removeButton);
            previewContainer.appendChild(previewDiv);
        };
        reader.readAsDataURL(file);
    });
}

// Optional: Allow user to remove previously uploaded image previews (as per the button click above)
function removeImagePreview(button) {
    const previewContainer = document.getElementById('imagePreviews');
    previewContainer.removeChild(button.parentElement);  // Remove the specific image preview
}

    </script>
@endsection
