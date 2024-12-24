@php
    $title = 'My Vacay Host';
    $filename = 'Edit Package Type';
@endphp
@extends('admin.layouts.app')
@section('title', $title)
@section('filename', $filename)
@section('content')

    <div class="col-md-12 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit Package Type</h4>

            </div>
            <div class="card-content">
                <div class="card-body">
                    <form class="form form-vertical" action="{{ route('package-type.update', $packageType->id) }}"
                        method="post" enctype="multipart/form-data" id="createDrawDestination">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="form-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Icon<span class="text-danger">*</span></label>
                                        <input type="file" id="name-vertical" class="form-control" name="icon"
                                            value="{{ $packageType->icon }}" placeholder="Icon">
                                    </div>
                                    @error('icon')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Name<span class="text-danger">*</span></label>
                                        <input type="text" id="name-vertical" class="form-control" name="name" maxlength="15"
                                            value="{{ $packageType->name }}" placeholder="name">
                                    </div>
                                    @error('name')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Select parent category</label>
                                        <select type="text" name="parent_id" class="form-control">
                                            <option value="">None</option>
                                            @if($packageSubType)
                                                @foreach($packageSubType as $item)
                                                    <?php $dash=''; ?>
                                                    <option value="{{$item->id}}" @if($packageType->parent_id == $item->id ) selected @endif>{{$item->name}}</option>
                                                    @if(count($item->subpackage))
                                                        @include('admin.package-type.sub-package-list-option-for-update',['subcategories' => $item->subpackage])
                                                    @endif
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                {{-- <div class="col-6">
                                    <div class="form-group">
                                        <label for="days">Status</label>
                                        <select class="form-select" id="basicSelect" name="status">
                                            <option value="{{ $packageType->status }}">{{ $packageType->status }}</option>
                                            <option value="Active">Active</option>
                                            <option value="InActive">InActive</option>
                                        </select>
                                    </div>
                                </div> --}}
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
            $('#createDrawDestination').validate({ // initialize the plugin
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
                        required: "Please enter the name of the package type."
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
