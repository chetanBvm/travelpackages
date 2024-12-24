@php
    $title = 'My Vacay Host';
    $filename = 'Edit Departure City';
@endphp
@extends('admin.layouts.app')
@section('title', $title)
@section('filename', $filename)
@section('content')

    <div class="col-md-12 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit Departure Cities</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <form class="form form-vertical" action="{{ route('departure-city.update', $departureCity->id) }}"
                        method="post" enctype="multipart/form-data" id="createDrawDestination">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="form-body">
                            <div class="row">
                                                             
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="days">Name</label>
                                        <input type="text" id="name" class="form-control" name="name" maxlength="30" pattern="[A-Za-z\s]+" value="{{old('name',$departureCity->name) ?? ''}}" oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '')">
                                    </div>
                                    @error('name')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div>
                                                     
                                
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="price">Price</label>
                                        <input type="number" id="price" class="form-control" name="price" value="{{floor($departureCity->price) ?? ''}}" min="1" max="9999"
                                            placeholder="price">
                                    </div>
                                    @error('price')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div>
                                                                      
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                    <a href="{{route('departure-city.index')}}" type="button"
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
                    price:{
                        required: true
                    },

                },
                // Customizing error messages
                messages: {
                    name: {
                        required: "Please enter the name of the departure city."
                    },     
                    price:{
                        required: "Please enter the price."
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
