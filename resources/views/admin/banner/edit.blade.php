@php
    $title = 'My Vacay Host';
    $filename = 'Edit Banner';
@endphp
@extends('admin.layouts.app')
@section('title', $title)
@section('filename', $filename)
@section('content')

    <div class="col-md-12 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit Banner</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <form class="form form-vertical" action="{{ route('banner.update', $banner->id) }}" method="post"
                        enctype="multipart/form-data" id="createDrawBanner">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="form-body">
                            <div class="row">

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Name</label>
                                        <input type="text" id="name-vertical" class="form-control" name="name"
                                            value="{{ $banner->name }}" placeholder="Name">
                                    </div>
                                    @error('name')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="text-vertical">Text</label>
                                        <input type="text" id="text-vertical" class="form-control" name="text"
                                            value="{{ $banner->text }}" placeholder="text">
                                    </div>
                                    @error('text')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="text-vertical">Type</label>
                                        <select class="form-select" id="basicSelect" name="type">
                                            <option value="{{ $banner->type }}">{{ $banner->type }}</option>
                                            <option value="Home">Home</option>
                                            <option value="About">About</option>
                                        </select>
                                    </div>
                                    @error('type')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div> 

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select class="form-select" id="basicSelect" name="status">
                                            <option value="{{ $banner->status }}">{{ $banner->status }}</option>
                                            <option value="Active">Active</option>
                                            <option value="InActive">InActive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="image" for="">Image</label>
                                        <div class="@error('image') error @enderror">
                                            <input type="file" name="image" id="image"
                                                class="filestyle image_style" onchange="readURL(this);"
                                                accept="image/jpeg, image/png, image/gif, image/jpg">
                                        </div>
                                    </div>
                                    <div class="form-group preview_holder">
                                        <?php
                                        if($banner['image'] == ""){ ?>
                                        <img id="image" src="" class="image_style" alt="your image"
                                            style="display:none;" />
                                        <?php
                                        } else { ?>
                                        <img id="image" src="<?php echo asset('storage') . '/' . $banner['image']; ?>" class="image_style" alt="your image"
                                            style="display:block; width:100px;"  />
                                        <?php
                                        } ?>
                                        @error('image')
                                            <label class="error" role="alert">{{ $message }}</label>
                                        @enderror
                                    </div>

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
        //preview Image
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#image')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        //Validation script
        $(document).ready(function() {
            $('#createDrawBanner').validate({ // initialize the plugin
                rules: {
                    name: {
                        required: true
                    },
                    text:{
                        required:true
                    },
                    // image: {
                    //     required: true
                    // },
                    status: {
                        required: true
                    },
                },
                // Customizing error messages
                messages: {
                    name: {
                        required: "Please enter the name of the banner."
                    },
                    text:{
                        required: "Please enter the text of the banner."
                    }
                    // image: {
                    //     required: "Please choose the file."
                    // },
                    status: {
                        required: "Please select the status of the banner."
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
