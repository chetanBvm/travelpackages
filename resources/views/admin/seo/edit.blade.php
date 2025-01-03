@php
    $title = 'My Vacay Host';
    $filename = 'Seo Management';
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
                <h4 class="card-title">Seo Management</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <form class="form form-vertical" action="{{route('seo-management.update',$seo->id)}}" method="post"
                        enctype="multipart/form-data" id="createDrawHomeDestination">
                        @csrf
                        {{method_field('PUT')}}
                        <div class="form-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="heading-vertical">Title<span class="text-danger">*</span></label>
                                        <input type="text" id="heading-vertical"
                                            class="form-control @error('title') is-invalid @enderror" name="title"
                                            placeholder="title" value="{{ old('title', $seo->title ?? '') }}" maxlength="50">
                                    </div>
                                    @error('title')
                                        <span class="text-danger" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="sub-heading-vertical">Keywords<span class="text-danger">*</span></label>
                                        <input type="text" id="sub-heading-vertical"
                                            class="form-control @error('meta_keywords') is-invalid @enderror" name="meta_keywords"
                                            placeholder="keywords" value="{{ old('meta_keywords', $seo->meta_keywords ?? '') }}">
                                    </div>
                                    @error('meta_keywords')
                                        <span class="text-danger" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="sub-heading-vertical">Meta Description<span class="text-danger">*</span></label>
                                        <textarea id="editor" class="form-control" name="meta_description" placeholder="description">
                                            {{old('meta_description', $seo->meta_description ?? '') }}
                                        </textarea>                                       
                                    </div>
                                    @error('meta_description')
                                        <span class="text-danger" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>      
                                    <a href="{{route('seo-management.index')}}" type="button"
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
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });

        //Validation script
        $(document).ready(function() {
            $('#createDrawHomeDestination').validate({ // initialize the plugin
                rules: {
                    title: {
                        required: true,
                    },
                    meta_description: {
                        required: true
                    },
                    meta_keywords:{
                        required:true
                    }
                },
                // Customizing error messages
                messages: {
                    title: {
                        required: "The title field is required."
                    },
                    meta_description: {
                        required: "The description field is required."
                    },
                    meta_keywords:{
                        required: "The keywords field in required"
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
