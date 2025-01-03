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
                                        <label for="first-name-vertical">Package Name<span
                                                class="text-danger">*</span></label>
                                        <select class="form-select packageDropdown" id="basicSelect" name="package_id">
                                            <option>select package</option>
                                            @foreach ($package as $packages)
                                                <option value="{{ $packages->id }}"
                                                    {{ old('package_id') == $packages->id ? 'selected' : '' }}>
                                                    {{ $packages->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('package_id')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="days">Month Year<span class="text-danger">*</span></label>
                                        @php $months = currentYear(); @endphp
                                        <select name="year" id="year" class="form-select"
                                            aria-label="Default select example">
                                            <option>select month</option>
                                            {{-- @foreach ($months as $index => $month)
                                                <option value="{{ $month }}"
                                                    {{ old('year') == $month ? 'selected' : '' }}>
                                                    {{ $month }}</option>
                                            @endforeach --}}
                                        </select>
                                    </div>
                                    @error('year')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="days">Departure date<span class="text-danger">*</span></label>
                                        {{-- <input type="text" name="departure_date[]"
                                            class="form-control mb-3 flatpickr-no-config flatpickr-input" id="date"
                                            placeholder="Select date.." readonly="readonly"> --}}
                                        <input type="text" name="departure_date[]"
                                            class="form-control departure_date date-picker" id="date"
                                            placeholder="Select Date">

                                        {{-- <input type="date" id="date" class="form-control departure_date"
                                            name="departure_date[]" placeholder="Departure Date" min=""> --}}
                                    </div>
                                    @error('departure_date')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="return_date">Return Date<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control return_date date-picker" id="date"
                                            name="return_date[]" placeholder="Select Date">
                                        {{-- <input type="date" id="return_date" class="form-control return_date"
                                            name="return_date[]" placeholder="Return Date" min=""> --}}
                                    </div>
                                    @error('return_date')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="price">Price<span class="text-danger">*</span></label>
                                        <input type="number" id="price" min="0" max="9999999"
                                            oninput="this.value = this.value.slice(0, 7);" class="form-control"
                                            name="price[]" placeholder="Price">
                                    </div>
                                    @error('price')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="days">Accommodation Category<span
                                                class="text-danger">*</span></label>
                                        <select class="form-select" id="basicSelect" name="category[]">
                                            <option value="classic Hotels">classic Hotels</option>
                                            <option value="superior Hotels">superior Hotels</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="days">Status<span class="text-danger">*</span></label>
                                        <select class="form-select" id="basicSelect" name="status[]">
                                            <option value="On Request">On Request</option>
                                            <option value="Show Price">Show Price</option>
                                            <option value="Sold Out">Sold Out</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-end">
                                <button type="button" class="btn btn-primary me-1 mb-1" id="add-more-fields">+
                                    Add More</button>
                                <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                <a href="{{ route('departure-flights.index') }}" type="button"
                                    class="btn btn-light-secondary me-1 mb-1"><span>Back</span></a>
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
        function initializeDatePickers() {
            flatpickr('.date-picker', {
                dateFormat: "Y-m-d",
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            initializeDatePickers();
        });
    </script>

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
                    departure_date: {
                        required: true
                    },
                    return_date: {
                        required: true
                    },
                    price: {
                        required: true
                    },
                    status: {
                        required: true
                    },
                    category: {
                        required: true
                    }
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
                    price: {
                        required: "Please enter the price."
                    },
                    status: {
                        required: "Please select the status."
                    },
                    category: {
                        required: 'Please select the accommodation category'
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

            function applyDateLogic() {
                $('.departure_date').each(function() {
                    const today = new Date().toISOString().split('T')[0];
                    $(this).attr('min', today); // Set the minimum date for departure dates

                    // Add event listener for departure date change
                    $(this).off('change').on('change', function() {
                        const selectedDepartureDate = $(this).val();
                        const returnInput = $(this).closest('.dynamic-fields').find('.return_date');
                        if (selectedDepartureDate) {
                            returnInput.attr('min',
                                selectedDepartureDate); // Update the minimum date for return date
                        } else {
                            returnInput.removeAttr('min'); // Reset if no date is selected
                        }
                    });
                });

                $('.return_date').each(function() {
                    // Add event listener for return date change
                    $(this).off('change').on('change', function() {
                        const selectedReturnDate = $(this).val();
                        const departureInput = $(this).closest('.dynamic-fields').find(
                            '.departure_date').val();
                        if (selectedReturnDate && selectedReturnDate < departureInput) {
                            alert('Return date cannot be earlier than the departure date.');
                            $(this).val(''); // Clear invalid value
                        }
                    });
                });
            }

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
                initializeDatePickers();
                if (fieldCounter < maxFields) {
                    fieldCounter++;
                    const newFields = `
                    <div class="row dynamic-fields">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="departure_date">Departure Date<span class="text-danger">*</span></label>
                                <input type="text" class="departure_date form-control date-picker" id="date" name="departure_date[]" placeholder="Departure Date" min="">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="return_date">Return Date<span class="text-danger">*</span></label>
                                <input type="text" class="return_date form-control date-picker" name="return_date[]"  placeholder="Return Date" min="">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="price">Price<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="price[]" placeholder="Price" >
                            </div>
                        </div>
                         <div class="col-6">
                                    <div class="form-group">
                                        <label for="days">Accommodation Category<span class="text-danger">*</span></label>
                                        <select class="form-select" id="basicSelect" name="category[]">
                                            <option value="classic Hotels">classic Hotels</option>
                                            <option value="superior Hotels">superior Hotels</option>
                                        </select>
                                    </div>
                                </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="status">Status<span class="text-danger">*</span></label>
                                <select class="form-select" name="status[]">
                                    <option value="On Request">On Request</option>
                                            <option value="Show Price">Show Price</option>
                                            <option value="Sold Out">Sold Out</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-end">
                            <button type="button" class="btn btn-danger remove-fields" style="margin:10px;">- Remove</button>
                        </div>
                    </div>`;
                    $('#dynamic-fields-container').append(newFields);
                    initializeDatePickers();

                    applyDateLogic();
                    toggleSubmitButton();
                    toggleAddMoreButton(); // Check and update "Add More" button visibility
                } else {
                    Swal.fire(
                        'info',
                        'Maximum number of fields reached',
                        'info'
                    )
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
            applyDateLogic();
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
