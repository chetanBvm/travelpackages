@php
    $title = 'My Vacay Host';
    $filename = 'Edit Travel Experience';
@endphp
@extends('admin.layouts.app')
@section('title', $title)
@section('filename', $filename)
@section('content')

    <div class="col-md-12 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit Travel Experience</h4>
                <a href="{{ route('travel-experience.index') }}" type="button"
                    class="btn btn-info gray-btn d-lg-block m-l-15"><i class="bi bi-caret-left-fill"></i><span>Back</span></a>

            </div>
            <div class="card-content">
                <div class="card-body">
                    <form class="form form-vertical" action="{{ route('travel-experience.update', $travel->id) }}"
                        method="post" enctype="multipart/form-data" id="createDrawStay">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="form-body">
                            <div class="row">

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Name</label>
                                        <input type="text" id="name-vertical" class="form-control" name="name"
                                            value="{{ $travel->name }}" placeholder="Name">
                                    </div>
                                    @error('name')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
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
                                        if($travel['image'] == ""){ ?>
                                        <img id="image" src="" class="image_style" alt="your image"
                                            style="display:none;" />
                                        <?php
                                        } else { ?>
                                        <img id="image" src="<?php echo asset('storage') . '/' . $travel['image']; ?>" class="image_style" alt="your image"
                                            style="display:block; width:100px;" />
                                        <?php
                                        } ?>
                                        @error('image')
                                            <label class="error" role="alert">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="">Description</label>
                                        <textarea name="description" id="editor" cols="30" rows="10">{{ old('description', $travel->description ?? '') }}</textarea>
                                    </div>
                                    @error('description')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
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
    <script src="{{ asset('admin/assets/vendors/ckeditor/ckeditor.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });


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
            $('#createDrawStay').validate({ // initialize the plugin
                rules: {
                    name: {
                        required: true
                    },
                    status: {
                        required: true
                    },
                },
                // Customizing error messages
                messages: {
                    name: {
                        required: "Please enter the name of the stay."
                    },
                    status: {
                        required: "Please select the status of the stay."
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
