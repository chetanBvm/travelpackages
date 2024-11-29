@php
    $title = 'My Vacay Host';
    $filename = 'Edit Promotion';
@endphp
@extends('admin.layouts.app')
@section('title', $title)
@section('filename', $filename)
@section('content')

    <div class="col-md-12 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit Promotion</h4>
                <a href="#" type="button"
                class="btn btn-info gray-btn d-lg-block m-l-15"><i class="bi bi-caret-left-fill"></i><span>Back</span></a>

            </div>
            <div class="card-content">
                <div class="card-body">
                    <form class="form form-vertical" action="{{ route('promotion.update',$promotion->id) }}" method="post"
                        enctype="multipart/form-data" id="createDrawPromotion">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="form-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Name</label>
                                        <input type="text" id="name-vertical" class="form-control" name="name"
                                            placeholder="Name" value="{{$promotion->name}}">
                                    </div>
                                    @error('name')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                <div class="form-group">
                                    <label for="code">Code</label>
                                    <input type="text" id="code" class="form-control" name="code"
                                        placeholder="code" value="{{$promotion->code}}">
                                </div>
                                @error('code')
                                    <span class="text-danger" role="alert">*{{ $message }}</span>
                                @enderror
                            </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="price">Price</label>
                                        <input type="text" id="price" class="form-control" name="price"
                                            placeholder="price" value="{{$promotion->price}}">
                                    </div>
                                    @error('price')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="type">Type</label>
                                        <input type="text" id="type" class="form-control" name="type"
                                            placeholder="type" value="{{$promotion->type}}">
                                    </div>
                                    @error('type')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="type">Expiry Date</label>
                                        <input type="date" id="expiry_date" class="form-control" name="expiry_date"
                                            placeholder="expiry date" value="{{$promotion->expiry_date}}">
                                    </div>
                                    @error('expiry_date')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="days">Status</label>
                                        <select class="form-select" id="basicSelect" name="status">
                                            <option value="{{$promotion->status}}">{{$promotion->status}}</option>
                                            <option value="Active">Active</option>
                                            <option value="InActive">InActive</option>
                                        </select>
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
            $('#createDrawPromotion').validate({ // initialize the plugin
                rules: {
                    name: {
                        required: true,
                    },
                    code:{
                        required:true,
                    },
                    price:{
                        required:true,
                    },
                    expiry_date:{
                        required:true
                    },
                    type: {
                        required: true
                    },
                    status: {
                        required: true
                    },
                },
                // Customizing error messages
                messages: {
                    name: {
                        required: "Please enter the name of the promotion."
                    },
                    code:{
                        required: "Please enter the code of the promotion"
                    },
                    type: {
                        required: "Please enter the type of the promotion."
                    },
                    price: {
                        required: "Please enter the price of the promotion."
                    },
                    expiry_date:{
                        required: "Please enter the expiry date of the promotion."
                    },
                    status: {
                        required: "Please select the status of the promotion."
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
