@php
    $title = 'My Vacay Host';
    $filename = 'Home logo';
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
                <h4 class="card-title">Create Logo</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <form class="form form-vertical" action="{{ route('logo.save') }}" method="post"
                        enctype="multipart/form-data" id="createDrawHomeBanner">
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Home Logo <span class="text-danger">*</span></label>
                                        <input type="file" name="image[0][home]" id="main_image"
                                            class="form-control @error('image') is-invalid @enderror"
                                            value="{{ old('image') }}"
                                            accept = 'image/jpeg , image/jpg, image/gif, image/png'>
                                        @error('image')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>                                    
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Footer Logo <span class="text-danger">*</span></label>
                                        <input type="file" name="image[1][footer]" id="main_image"
                                            class="form-control @error('image') is-invalid @enderror"
                                            value="{{ old('image') }}"
                                            accept = 'image/jpeg , image/jpg, image/gif, image/png'>
                                        @error('image')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>                                    
                                </div>
                                <div class="mt-3">
                                    @if (isset($logo->image) && $logo->image)
                                        @php
                                            // Decode the JSON-encoded image field
                                            $images = json_decode($logo->image, true);
                                        @endphp                                
                                        @foreach ($images as $area => $imagePath)
                                            <div class="image-preview">
                                                <h4>{{ ucfirst($area) }} Image</h4>
                                                <img class="profile-image"
                                                    src="{{ asset('storage/' . $imagePath) }}"
                                                    alt="{{ $area }} image"
                                                    width="100px" height="auto" style="margin-right: 10px;" />
                                            </div>
                                        @endforeach
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
    </script>
@endsection
