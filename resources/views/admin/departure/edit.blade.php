@php
    $title = 'My Vacay Host';
    $filename = 'Edit Departure Flight';
@endphp
@extends('admin.layouts.app')
@section('title', $title)
@section('filename', $filename)
@section('content')

    <div class="col-md-12 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit Departure Flight</h4>
                <a href="{{route('departure-flights.index')}}" type="button"
                class="btn btn-info gray-btn d-lg-block m-l-15"><i class="bi bi-caret-left-fill"></i><span>Back</span></a>

            </div>
            <div class="card-content">
                <div class="card-body">
                    <form class="form form-vertical" action="{{ route('departure-flights.update', $departureFlight->id) }}"
                        method="post" enctype="multipart/form-data" id="createDrawDestination">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="form-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Package Name</label>
                                        <select class="form-select" id="basicSelect" name="package_id">
                                            @foreach ($package as $value)
                                                <option value="{{ $value->id }}"
                                                    {{ $value->id == $departureFlight->package_id ? 'selected' : '' }}>
                                                    {{ $value->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('package_id')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div>
                                <!--Year-->
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="days">Month Year</label>
                                        <input type="text" id="year" class="form-control" name="year" value="{{old('year',$departureFlight->year) ?? ''}}"
                                            placeholder="month Year Eg:December 2024">
                                    </div>
                                    @error('year')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="days">Departure date</label>
                                        <input type="text" id="year" class="form-control" name="departure_date" value="{{old('departure_date',$departureFlight->departure_date) ?? ''}}"
                                            placeholder="Departure date">
                                    </div>
                                    @error('departure_date')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="return_date">Return Date</label>
                                        <input type="text" id="return_date" class="form-control" name="return_date" value="{{old('return_date',$departureFlight->return_date) ?? ''}}"
                                            placeholder="return date">
                                    </div>
                                    @error('return_date')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="price">Price</label>
                                        <input type="text" id="price" class="form-control" name="price" value="{{$departureFlight->price ?? ''}}"
                                            placeholder="price">
                                    </div>
                                    @error('price')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="days">Accommodation Category</label>
                                        <select class="form-select" id="basicSelect" name="category">
                                            <option value="{{ $departureFlight->category }}">{{ $departureFlight->category }}</option>
                                            <option value="classic Hotels">classic Hotels</option>
                                            <option value="superior Hotels">superior Hotels</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="days">Status</label>
                                        <select class="form-select" id="basicSelect" name="status">
                                            <option value="{{ $departureFlight->status }}">{{ $departureFlight->status }}</option>
                                            <option value="On request">On Request</option>
                                            <option value="Show Price">Show Price</option>
                                            <option value="Sold Out">Sold Out</option>
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
            $('#createDrawDestination').validate({ // initialize the plugin
                rules: {
                    package_id: {
                        required: true
                    },
                    year: {
                        required: true
                    },
                    departure_date:{
                        required: true
                    },
                    return_date:{
                        required: true
                    },
                    // price:{
                    //     required: true
                    // },
                    status: {
                        required: true
                    },
                },
                // Customizing error messages
                messages: {
                    package_id: {
                        required: "Please select the Package name of the departure flight."
                    },
                    year: {
                        required: "Pease Enter Month or year"
                    },
                    departure_date:{
                        required: "Please enter the departure date."
                    },
                    return_date:{
                        required: "Please enter the return date."
                    },
                    // price:{
                    //     required: "Please enter the price."
                    // },
                    status: {
                        required: "Please select the status."
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
