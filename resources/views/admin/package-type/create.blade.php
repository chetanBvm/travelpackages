@php
    $title = 'My Vacay Host';
    $filename = 'Create Package Type';
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
                <h4 class="card-title">Create Package Type</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <form class="form form-vertical" action="{{ route('package-type.store') }}" method="post"
                        enctype="multipart/form-data" id="createDrawPackages">
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                {{-- <div class="col-6">
                                    <div class="form-group">
                                        <label for="icon-vertical">Icon<span class="text-danger">*</span></label>
                                        <input type="file" id="icon-vertical" class="form-control" name="icon"
                                            placeholder="Icon" value="{{ old('icon') }}" accept="image/jpeg, image/png, image/gif, image/jpg,image/svg">
                                    </div>
                                    @error('icon')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div> --}}
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Name<span class="text-danger">*</span></label>
                                        <input type="text" id="first-name-vertical" class="form-control" name="name" maxlength="25"
                                            placeholder="Name" value="{{ old('name') }}">
                                    </div>
                                    @error('name')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Select Parent Package Type</label>
                                        <select type="text" name="parent_id" class="form-control">
                                            <option value="">None</option>
                                            @if ($categories)
                                                @foreach ($categories as $category)
                                                    <?php $dash = ''; ?>
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @if (count($category->subpackage))
                                                        @include('admin.package-type.subPackageList-option', [
                                                            'subcategories' => $category->subpackage,
                                                        ])
                                                    @endif
                                                @endforeach
                                            @endif
                                        </select>                                       
                                    </div>                               
                                </div>
               
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                    <a href="{{ route('package-type.index') }}" type="button"
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

    <script>
        //Validation script
        $(document).ready(function() {
            $('#createDrawPackages').validate({ // initialize the plugin
                rules: {
                    // icon: {
                    //     required: true
                    // },
                    name: {
                        required: true,
                    },
                    status: {
                        required: true
                    },
                },
                // Customizing error messages
                messages: {
                    // icon: {
                    //     required: "Please choose the icon."
                    // },
                    name: {
                        required: "Please enter the name of the package.",
                    },
                    status: {
                        required: "Please select the status."
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
