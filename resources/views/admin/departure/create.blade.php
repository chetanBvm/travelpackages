@php
    $title = 'My Vacay Host';
    $filename = 'Create Departure Flight';
@endphp
@extends('admin.layouts.app')
@section('title', $title)
@section('filename', $filename)
@section('content')

    <div class="col-md-12 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Create Departure Flight</h4>
                <a href="{{ route('departure-flights.index') }}" type="button"
                    class="btn btn-info gray-btn d-lg-block m-l-15"><i class="bi bi-caret-left-fill"></i><span>Back</span></a>

            </div>
            <div class="card-content">
                <div class="card-body">
                    <form class="form form-vertical" action="{{ route('departure-flights.store') }}" method="post"
                        enctype="multipart/form-data" id="createDrawDepartureFlight">
                        @csrf
                        <div class="form-body">
                            <div class="row" id="dynamic-fields-container">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Package Name</label>
                                        <select class="form-select" id="basicSelect" name="package_id">
                                            @foreach ($package as $packages)
                                                <option value="{{ $packages->id }}">{{ $packages->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('package_id')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="days">Month Year</label>
                                        <input type="text" id="year" class="form-control" name="year"
                                            placeholder="month Year Eg:December 2024">
                                    </div>
                                    @error('year')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="days">Departure date</label>
                                        <input type="date" id="date" class="form-control" name="departure_date[]"
                                            placeholder="Departure Date">
                                    </div>
                                    @error('departure_date')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="return_date">Return Date</label>
                                        <input type="date" id="return_date" class="form-control" name="return_date[]"
                                            placeholder="Return Date">
                                    </div>
                                    @error('return_date')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="price">Price</label>
                                        <input type="text" id="price" class="form-control" name="price[]"
                                            placeholder="Price">
                                    </div>
                                    @error('price')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="days">Status</label>
                                        <select class="form-select" id="basicSelect" name="status[]">
                                            <option value="Active">Active</option>
                                            <option value="InActive">InActive</option>
                                            <option value="Sold Out">Sold Out</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-end">
                                <button type="button" class="btn btn-success" id="add-more-fields">+ Add More</button>
                            </div>
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
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
            $('#createDrawDepartureFlight').validate({ // initialize the plugin
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
                    price:{
                        required: true
                    },
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
                    price:{
                        required: "Please enter the price."
                    },
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

    <script>
        $(document).ready(function() {
            let fieldCounter = 1; // To keep track of added fields
            const maxFields = 20; // Maximum number of fields allowed

            // Function to toggle the visibility of the submit button
            function toggleSubmitButton() {
                const allFieldsFilled = $('#dynamic-fields-container')
                    .find('input, select')
                    .filter('[name^="departure_date"], [name^="return_date"], [name^="price"], [name^="status"]')
                    .toArray()
                    .every((field) => $(field).val() !== '');

                if (allFieldsFilled) {
                    $('#submit-container').fadeIn();
                } else {
                    $('#submit-container').fadeOut();
                }
            }

            // Function to toggle the visibility of the "Add More" button
            function toggleAddMoreButton() {
                if (fieldCounter >= maxFields) {
                    $('#add-more-fields').hide(); // Hide the "Add More" button when limit is reached
                } else {
                    $('#add-more-fields').show(); // Show the button if limit is not reached
                }
            }

            // Add More Fields
            $('#add-more-fields').click(function() {
                if (fieldCounter < maxFields) {
                    fieldCounter++;
                    const newFields = `
                    <div class="row dynamic-fields">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="departure_date">Departure Date</label>
                                <input type="date" class="form-control" name="departure_date[]" placeholder="Departure Date">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="return_date">Return Date</label>
                                <input type="date" class="form-control" name="return_date[]" placeholder="Return Date">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="text" class="form-control" name="price[]" placeholder="Price">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-select" name="status[]">
                                    <option value="Active">Active</option>
                                    <option value="InActive">InActive</option>
                                    <option value="Sold Out">Sold Out</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-end">
                            <button type="button" class="btn btn-danger remove-fields">- Remove</button>
                        </div>
                    </div>`;
                    $('#dynamic-fields-container').append(newFields);
                    toggleSubmitButton();
                    toggleAddMoreButton(); // Check and update "Add More" button visibility
                } else {
                    Swal.fire(
                        'info',
                        'Maximum number of fields reached',
                        'info'
                    )
                    // alert('Maximum number of fields reached.');
                }
            });

            // Remove Fields
            $(document).on('click', '.remove-fields', function() {
                $(this).closest('.dynamic-fields').remove();
                fieldCounter--;
                toggleSubmitButton();
                toggleAddMoreButton(); // Update "Add More" button visibility after removal
            });

            // Toggle Submit Button on Input Change
            $(document).on('input change', '#dynamic-fields-container input, #dynamic-fields-container select',
                function() {
                    toggleSubmitButton();
                });

            // Initialize Submit Button and Add More Button Visibility
            toggleSubmitButton();
            toggleAddMoreButton();
        });
    </script>


@endsection
