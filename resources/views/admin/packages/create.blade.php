@php
    $title = 'My Vacay Host';
    $filename = 'Create Packages';
@endphp
@extends('admin.layouts.app')
@section('title', $title)
@section('filename', $filename)
@section('content')
    @php
        use Carbon\Carbon;
        // Get the current year
        $currentYear = Carbon::now();

        // Array to hold the months
        $months = [];

        // Generate the months for the current year
        for ($i = 0; $i <= 12; $i++) {
            $months[] = $currentYear->copy()->addMonthsNoOverflow($i)->format('M Y');
        }
    @endphp
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
                                        <label for="destination-vertical">Destination<span
                                                class="text-danger">*</span></label>
                                        <select class="form-select destination" id="basicSelect" name="destination_id">
                                            <option value="">Select Destination</option>
                                            @foreach ($destination as $value)
                                                <option value="{{ $value->id }}"
                                                    {{ old('destination_id') == $value->id ? 'selected' : '' }}>
                                                    {{ $value['country']->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('destination_id')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Package Name<span
                                                class="text-danger">*</span></label>
                                        <input type="text" id="package-name" class="form-control" name="name"
                                            placeholder="Enter package (Eg:land & sea)" maxlength="50"
                                            value="{{ old('name') }}">
                                    </div>
                                    <div id="package-name-feedback"></div>
                                    @error('name')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="name-vertical">Sub Title</label>
                                        <input type="text" id="name-vertical" class="form-control" maxlength="50"
                                            name="sub_title" placeholder="Eg: Per night before taxes and fees"
                                            value="{{ old('sub_title') }}">
                                    </div>
                                    @error('sub_title')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="price">Price<span class="text-danger">*</span></label>
                                        <input type="number" id="price" min="0" max="9999999"
                                            class="form-control" name="price"
                                            oninput="this.value = this.value.slice(0, 7);" placeholder="price"
                                            value="{{ old('price') }}">
                                    </div>
                                    @error('price')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="price">Tax(%)<span class="text-danger">*</span></label>
                                        <input type="number" id="tax" class="form-control" name="tax"
                                            min="0" max="99" oninput="if(this.value > 99) this.value = 99;"
                                            placeholder="tax percentage(Eg:18)" value="{{ old('tax') }}">
                                    </div>
                                    @error('tax')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="price">Tax Amount</label>
                                        <input type="text" id="tax_rate" class="form-control" name="tax_rate"
                                            placeholder="tax rate" value="{{ old('tax_rate') }}" readonly>
                                    </div>
                                    @error('tax_rate')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="price">Total Price</label>
                                        <input type="text" id="total_price" class="form-control" name="total_price"
                                            placeholder="total price" value="{{ old('total_price') }}"readonly>
                                    </div>
                                    @error('total_price')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="days">Package Type<span class="text-danger">*</span></label>
                                        <select class="form-select" id="basicSelect" name="packagetype_id">
                                            <option>select package type</option>
                                            @foreach ($packageType as $value)
                                                <option value="{{ $value->id }}"
                                                    {{ old('packagetype_id') == $value->id ? 'selected' : '' }}>
                                                    {{ $value->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('packagetype_id')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="days">Days<span class="text-danger">*</span></label>
                                        <input type="number" id="days" class="form-control" name="days"
                                            min="1" max="365" placeholder="days"
                                            value="{{ old('days') }}">
                                    </div>
                                    @error('days')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="days">Month<span class="text-danger">*</span></label>
                                        <select class="form-control choices multiple-remove" name="departure_month[]"
                                            multiple="multiple">
                                            @foreach ($months as $index => $month)
                                                <option value="{{ $index + 1 }}"
                                                    {{ old('departure_month') == $index + 1 ? 'selected' : '' }}>
                                                    {{ $month }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('departure_month')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="min_age">Min Age Limitation<span class="text-danger">*</span></label>
                                        <input type="text" id="min-age" class="form-control" name="min_age"
                                            placeholder="Min Age" min="5" max="99" pattern="[0-9\s]+"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                            value="{{ old('min_age') }}">
                                    </div>
                                    <span class="text-danger" id="min-age-error"></span>
                                    @error('min_age')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="max_age">Max Age Limitation<span class="text-danger">*</span></label>
                                        <input type="text" id="max-age" class="form-control" name="max_age"
                                            placeholder="max age" min="5" max="99" pattern="[0-9\s]+"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                            value="{{ old('max_age') }}">
                                    </div>
                                    <span class="text-danger" id="max-age-error"></span>
                                    @error('max_age')
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
                                        <label class="image" for="">Upload Image<span
                                                class="text-danger">*</span></label>
                                        <input type="file" class="form-control" name="images[]" id="main_image"
                                            accept="image/jpeg, image/png, image/gif, image/jpg, image/svg" multiple>
                                    </div>
                                </div>
                                <div id="imagePreview" style="display: flex; flex-wrap: wrap;">
                                </div>
                                <input type="hidden" name="thumbnail" id="thumbnail-input">

                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="image" for="">Map Image<span
                                                class="text-danger">*</span></label>
                                        <input type="file" class="form-control" name="map_image" id="map_image"
                                            accept="image/jpeg, image/png, image/gif, image/jpg">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="default">Description</label>
                                        <textarea name="description" id="editor2" cols="30" rows="10">{{ old('description') }}</textarea>
                                    </div>
                                    @error('description')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="default-acc">Accommodation Description<span
                                                class="text-danger">*</span></label>
                                        <textarea name="accommodation" id="editor" cols="50" rows="50">{{ old('accommodation') }}</textarea>
                                    </div>
                                    @error('accommodation')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="default-inc">Package Includes<span
                                                class="text-danger">*</span></label>
                                        <textarea name="package_includes" id="editor1" cols="30" rows="10">{{ old('package_includes') }}</textarea>
                                    </div>
                                    @error('package_includes')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="default-inc">Inclusion<span class="text-danger">*</span></label>
                                        <textarea name="inclusion" id="editor3" cols="30" rows="10">{{ old('inclusion') }}</textarea>
                                    </div>
                                    @error('inclusion')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="default-inc">Exclusion<span class="text-danger">*</span></label>
                                        <textarea name="exclusion" id="editor4" cols="30" rows="10">{{ old('exclusion') }}</textarea>
                                    </div>
                                    @error('exclusion')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="default-inc">Itinerary<span class="text-danger">*</span></label>
                                        <textarea name="itinerary" id="editor5" cols="30" rows="10">{{ old('itinerary') }}</textarea>
                                    </div>
                                    @error('itinerary')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                    <a href="{{ route('package.index') }}" type="button"
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
        ClassicEditor
            .create(document.querySelector('#editor1'))
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#editor2'))
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#editor3'))
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#editor4'))
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#editor5'))
            .catch(error => {
                console.error(error);
            });



        //Validation script
        $(document).ready(function() {
            $('#createDrawPackages').validate({ // initialize the plugin
                rules: {
                    destination_id: {
                        required: true,
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
                    status: {
                        required: true
                    },
                    tax: {
                        required: true
                    },
                    packagetype_id: {
                        required: true
                    },
                    package_includes: {
                        required: true
                    },
                    accommodation: {
                        required: true
                    },
                    max_age: {
                        required: true
                    },
                    min_age: {
                        required: true
                    },
                    inclusion: {
                        required: true
                    },
                    exclusion: {
                        required: true
                    },
                    itinerary: {
                        required: true
                    },
                    departure_month: {
                        required: true
                    }
                },
                // Customizing error messages
                messages: {
                    destination_id: {
                        required: "Please select the destination."
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
                    status: {
                        required: "Please select the status."
                    },
                    tax: {
                        required: 'Please enter the tax.'
                    },
                    packagetype_id: {
                        required: 'Please select the Package type'
                    },
                    accommodation: {
                        required: 'Please enter the accommodation.'
                    },
                    package_includes: {
                        required: 'Please enter the package includes'
                    },
                    max_age: {
                        required: 'Please enter the max age.'
                    },
                    min_age: {
                        required: 'Please enter the min age.'
                    },
                    inclusion: {
                        required: 'Please enter the inclusion.'
                    },
                    exclusion: {
                        required: 'Please enter the exclusion.'
                    },
                    itinerary: {
                        required: 'Please enter the itinerary.'
                    },
                    departure_month: {
                        required: 'please select the departure month.'
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
    <script>
        document.getElementById('max-age').addEventListener('change', function() {
            const maxAge = parseInt(this.value);
            const minAge = parseInt(document.getElementById('min-age').value);
            const minAgeError = document.getElementById('min-age-error');
            const maxAgeError = document.getElementById('max-age-error');

            minAgeError.textContent = '';
            maxAgeError.textContent = '';

            if (maxAge < minAge) {
                maxAgeError.textContent = 'Max Age should be greater than or equal to Min Age.';
                this.value = '';
            }
        });

        document.getElementById('min-age').addEventListener('change', function() {
            const minAge = parseInt(this.value);
            const maxAge = parseInt(document.getElementById('max-age').value);

            if (minAge > maxAge) {
                minAgeError.textContent = 'Min Age should be less than or equal to Max Age.';
                this.value = '';
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            let selectedImages = [];
            let thumbnailIndex = null;

            // Handle file input change
            $('#main_image').on('change', function(event) {
                const files = event.target.files;
                $('#imagePreview').html('');

                Array.from(files).forEach((file, index) => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const imgIndex = selectedImages.length;
                        selectedImages.push(file);

                        // Add preview
                        $('#imagePreview').append(`
                        <div class="preview-container" data-index="${imgIndex}">
                            <div class="image-wrapper">
                            <img src="${e.target.result}" class="img-thumbnail preview-img" alt="Image Preview">
                            <button type="button" class="btn btn-danger btn-sm remove-btn" data-index="${imgIndex}"> &times;</button>
                            <button type="button" class="btn btn-primary btn-sm thumbnail-btn" data-index="${imgIndex}">Set as Thumbnail</button>
                                </div>
                            
                        </div>
                    `);
                    };
                    reader.readAsDataURL(file);
                });
            });

            $(document).on('click', '.thumbnail-btn', function() {
                const index = $(this).data('index');
                thumbnailIndex = index; // Set thumbnail index
                $('#thumbnail-input').val(index); // Update thumbnail input value
                $('.thumbnail-btn').removeClass('btn-success').text(
                    'Set as Thumbnail'); // Reset all buttons
                $(this).addClass('btn-success').text('Thumbnail'); // Highlight selected thumbnail
            });

            // Handle remove button click
            $(document).on('click', '.remove-btn', function() {
                const index = $(this).data('index');
                $(`.preview-container[data-index="${index}"]`).remove();
                selectedImages[index] = null;
                if (thumbnailIndex === index) {
                    thumbnailIndex = null;
                    $('#thumbnail-input').val('');
                }
            });

            // Handle set as thumbnail button click
            $(document).on('click', '.thumbnail-btn', function() {
                const index = $(this).data('index');
                thumbnailIndex = index;
                $('#thumbnail-input').val(index);
                $('.thumbnail-btn').removeClass('btn-success').text('Set as Thumbnail');
                $(this).addClass('btn-success').text('Thumbnail');
            });


        });
    </script>

    <script>      
            $(document).ready(function() {
                $("#package-name").on("keyup", function() {
                    var packageName = $(this).val(); 
                    var destination = $(".destination").val();
                  
                    if (packageName.length > 2 && destination != '') { 
                        $.ajax({
                            url: '{{ route('check.package.name') }}', 
                            method: 'GET', 
                            data: {
                                package_name: packageName, 
                                departure_id: destination
                            },
                            success: function(response) {
                                if (response.exists) {
                                    $('#package-name-feedback').text('Package name already exists')
                                        .css('color', 'red');
                                } else {                                    
                                    $('#package-name-feedback').text('Package name is available')
                                        .css('color', 'green');
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error(error);
                            }
                        });
                    }
                });
            });
    </script>

    <!-- Add a field for feedback message -->
    <div id="package-name-feedback"></div>
@endsection
