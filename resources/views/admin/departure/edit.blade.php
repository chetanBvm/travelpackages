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
                                        <label for="first-name-vertical">Package Name<span class="text-danger">*</span></label>
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
                                        <label for="days">Month Year<span class="text-danger">*</span></label>
                                        @php $months = currentYear(); @endphp
                                        <select name="year" id="year" class="form-select"
                                            aria-label="Default select example">
                                            @foreach ($months as $index => $month)
                                                <option value="{{ $month}}"
                                                    {{ old('year', $departureFlight->year ?? '') == $month ? 'selected' : '' }}>
                                                    {{ $month }}</option>
                                            @endforeach
                                        </select>
                                      
                                    </div>
                                    @error('year')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="days">Departure date<span class="text-danger">*</span></label>
                                        <input type="text" id="date" class="departure_date form-control" name="departure_date"
                                            value="{{ old('departure_date', $departureFlight->departure_date) ?? '' }}"
                                            placeholder="Departure date">
                                    </div>
                                    @error('departure_date')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="return_date">Return Date<span class="text-danger">*</span></label>
                                        <input type="text" id="date" class="return_date form-control"
                                            name="return_date"
                                            value="{{ old('return_date', $departureFlight->return_date) ?? '' }}"
                                            placeholder="return date">
                                    </div>
                                    @error('return_date')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="price">Price<span class="text-danger">*</span></label>
                                        <input type="number" id="price" class="form-control" name="price" min="0" 
                                        max="9999999" oninput="this.value = this.value.slice(0, 7);"
                                            value="{{ floor($departureFlight->price) ?? '' }}" placeholder="price">
                                    </div>
                                    @error('price')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="days">Accommodation Category<span class="text-danger">*</span></label>
                                        <select class="form-select" id="basicSelect" name="category">
                                            <option value="{{ $departureFlight->category }}">
                                                {{ $departureFlight->category }}</option>
                                            <option value="classic Hotels">classic Hotels</option>
                                            <option value="superior Hotels">superior Hotels</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="days">Status<span class="text-danger">*</span></label>
                                        <select class="form-select" id="basicSelect" name="status">
                                            <option value="{{ $departureFlight->status }}">{{ $departureFlight->status }}
                                            </option>
                                            <option value="On Request">On Request</option>
                                            <option value="Show Price">Show Price</option>
                                            <option value="Sold Out">Sold Out</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                    <a href="{{ route('departure-flights.index') }}" type="button"
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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

<script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Flatpickr
            flatpickr("#date", {
                dateFormat: "Y-m-d",
            });
        });
    </script>
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
                    departure_date: {
                        required: true
                    },
                    return_date: {
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
                    departure_date: {
                        required: "Please enter the departure date."
                    },
                    return_date: {
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const departureDateInputs = document.getElementsByClassName("departure_date");
            const returnDateInputs = document.getElementsByClassName('return_date');

            // Set the minimum date for the departure date to today
            const today = new Date().toISOString().split('T')[0];
            Array.from(departureDateInputs).forEach(function(input) {
                input.setAttribute('min', today);
            });

            // Update the minimum date for the return date based on the departure date
            Array.from(departureDateInputs).forEach(function(departureInput, index) {
                departureInput.addEventListener('change', function() {
                    const selectedDepartureDate = this.value;

                    // Get the corresponding return date input (by index)
                    const correspondingReturnInput = returnDateInputs[index];

                    if (selectedDepartureDate && correspondingReturnInput) {
                        correspondingReturnInput.setAttribute('min', selectedDepartureDate);
                    }
                });
            });

            // Optional: Clear return date if it is earlier than the selected departure date
            Array.from(returnDateInputs).forEach(function(returnInput, index) {
                returnInput.addEventListener('change', function() {
                    const selectedReturnDate = this.value;

                    // Get the corresponding departure date input (by index)
                    const correspondingDepartureInput = departureDateInputs[index];
                    const selectedDepartureDate = correspondingDepartureInput ?
                        correspondingDepartureInput.value : null;

                    if (selectedReturnDate && selectedDepartureDate && selectedReturnDate <
                        selectedDepartureDate) {
                        alert('Return date cannot be earlier than the departure date.');
                        this.value = ''; // Clear the invalid value
                    }
                });
            });
        });
    </script>
@endsection
