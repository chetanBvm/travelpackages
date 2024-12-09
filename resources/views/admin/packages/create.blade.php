@php
    $title = 'My Vacay Host';
    $filename = 'Create Packages';
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
                <h4 class="card-title">Create Packages</h4>
                <a href="{{ route('package.index') }}" type="button" class="btn btn-info gray-btn d-lg-block m-l-15"><i
                        class="bi bi-caret-left-fill"></i><span>Back</span></a>

            </div>
            <div class="card-content">
                <div class="card-body">
                    <form class="form form-vertical" action="{{ route('package.store') }}" method="post"
                        enctype="multipart/form-data" id="createDrawPackages">
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="destination-vertical">Destination</label>
                                        <select class="form-select" id="basicSelect" name="destination_id">
                                            <option value="">---</option>
                                            @foreach ($destination as $value)
                                                <option value="{{ $value->id }}">{{ $value['country']->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('destination_id')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Name</label>
                                        <input type="text" id="first-name-vertical" class="form-control" name="name"
                                            placeholder="Name" value="{{old('name')}}">
                                    </div>
                                    @error('name')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="name-vertical">sub Title</label>
                                        <input type="text" id="name-vertical" class="form-control" name="sub_title"
                                            placeholder="sub title">
                                    </div>
                                    @error('sub_title')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="price">Price</label>
                                        <input type="text" id="price" class="form-control" name="price"
                                            placeholder="price">
                                    </div>
                                    @error('price')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="price">Tax(%)</label>
                                        <input type="text" id="tax" class="form-control" name="tax"
                                            placeholder="tax">
                                    </div>
                                    @error('tax')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="price">Tax Amount</label>
                                        <input type="text" id="tax_rate" class="form-control" name="tax_rate"
                                            placeholder="tax rate" readonly>
                                    </div>
                                    @error('tax_rate')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="price">Total Price</label>
                                        <input type="text" id="total_price" class="form-control" name="total_price"
                                            placeholder="total price" readonly>
                                    </div>
                                    @error('total_price')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="days">Package Type</label>
                                        <select class="form-select" id="basicSelect" name="packagetype_id">
                                            @foreach ($packagetype as $value)
                                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('packagetype_id')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="days">Days</label>
                                        <input type="text" id="days" class="form-control" name="days"
                                            placeholder="days">
                                    </div>
                                    @error('days')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="days">Status</label>
                                        <select class="form-select" id="basicSelect" name="status">
                                            <option value="Active">Active</option>
                                            <option value="InActive">InActive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <div>
                                            <img id="imagePreview" class="profile-image"
                                                src="{{ asset('admin/assets/images/faces/1.jpg') }}" alt="your image"
                                                width="100px" height="auto" />
                                        </div>
                                        <label class="image" for="">Image</label>
                                        <input type="file" class="form-control" name="thumbnail" id="main_image"
                                            accept="image/jpeg, image/png, image/gif, image/jpg">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="default">Description</label>
                                        <textarea name="description" id="default" cols="30" rows="10">{{old('description')}}</textarea>
                                    </div>
                                    @error('description')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="default-acc">Accommodation Description<span class="text-danger">*</span></label>
                                        <textarea name="accommodation" id="default-acc" cols="30" rows="10">{{old('accommodation')}}</textarea>
                                    </div>
                                    @error('accommodation')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
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
    <script src="{{ asset('admin/assets/vendors/tinymce/tinymce.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

    <script>
        tinymce.init({
            selector: '#default'
        });
        tinymce.init({
            selector: '#default-acc'
        });
        tinymce.init({
            selector: '#dark',
            toolbar: 'undo redo styleselect bold italic alignleft aligncenter alignright bullist numlist outdent indent code',
            plugins: 'code'
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $("#imagePreview").attr("src", e.target
                        .result); //css("background-image", "url("+e.target.result+")");
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#main_image").change(function() {
            readURL(this);
        });

        //Validation script
        $(document).ready(function() {
            $('#createDrawPackages').validate({ // initialize the plugin
                rules: {
                    destination_id: {
                        required: true,
                    },
                    sub_title: {
                        required: true
                    },
                    name: {
                        required: true
                    },
                    price: {
                        required: true
                    },
                    days: {
                        required: true
                    },
                    description: {
                        required: true
                    },
                    status: {
                        required: true
                    },

                    tax: {
                        required: true
                    },
                    packagetype_id:{
                        required: true
                    },
                },
                // Customizing error messages
                messages: {
                    destination_id: {
                        required: "Please select the destination."
                    },
                    sub_title: {
                        required: "Please enter the sub title."
                    },
                    name: {
                        required: "Please enter the name of the package."
                    },
                    price: {
                        required: "Please enter the price."
                    },
                    days: {
                        required: "Please specify the number of days."
                    },
                    description: {
                        required: "Please provide a description."
                    },
                    status: {
                        required: "Please select the status."
                    },
                    tax: {
                        required: 'Please enter the tax.'
                    },
                    packagetype_id:{
                        required: 'Please select the Package type'
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

        $(document).ready(function() {
            $('#price, #tax').on('keyup', function() {
                const price = parseFloat($('#price').val()) || 0;
                const taxPercentage = parseFloat($('#tax').val()) || 0;

                // Calculate the tax amount and total price
                const taxAmount = (price * taxPercentage) / 100;
                const totalPrice = price + taxAmount;

                // Set the values in the respective input fields
                $('#tax_rate').val(taxAmount.toFixed(2));
                $('#total_price').val(totalPrice.toFixed(2));
            });
        })
    </script>
@endsection
