@php
    $title = 'My Vacay Host';
    $filename = 'Edit Destination';
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
            $months[] = $currentYear->copy()->addMonths($i)->format('M Y');
        }
    @endphp
    <div class="col-md-12 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit Packages</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <form class="form form-vertical" action="{{ route('package.update', $package->id) }}" method="post"
                        enctype="multipart/form-data" id="createDrawDestination">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="form-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="days">Destination<span class="text-danger">*</span></label>
                                        <select class="form-select" id="basicSelect" name="destination_id">
                                            @foreach ($destination as $value)
                                                <option value="{{ $value->id }}"
                                                    {{ $value->id == $package->destination_id ? 'selected' : '' }}>
                                                    {{ $value->country->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="first-name-vertical">sub Title<span class="text-danger">*</span></label>
                                        <input type="text" id="name-vertical" class="form-control" name="sub_title"
                                            value="{{ $package->sub_title }}" placeholder="sub title">
                                    </div>
                                    @error('sub_title')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Name<span class="text-danger">*</span></label>
                                        <input type="text" id="name-vertical" class="form-control" name="name"
                                            value="{{ $package->name }}" placeholder="Name">
                                    </div>
                                    @error('name')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="days">Price<span class="text-danger">*</span></label>
                                        <input type="text" id="price" class="form-control" name="price"
                                            value="{{ floor($package->price) }}" placeholder="price">
                                    </div>
                                    @error('price')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="price">Tax(%)<span class="text-danger">*</span></label>
                                        <input type="text" id="tax" class="form-control" name="tax"
                                            placeholder="tax" value="{{ floor($package->tax) }}">
                                    </div>
                                    @error('tax')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="price">Tax Amount</label>
                                        <input type="text" id="tax_rate" class="form-control" name="tax_rate"
                                            placeholder="tax rate" value="{{ floor($package->tax_rate) ?? '' }}" readonly>
                                    </div>
                                    @error('tax_rate')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="price">Total Price</label>
                                        <input type="text" id="total_price" class="form-control" name="total_price"
                                            placeholder="total price" value="{{ floor($package->total_price) ?? '' }}"
                                            readonly>
                                    </div>
                                    @error('total_price')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="days">Package Type<span class="text-danger">*</span></label>
                                        <select class="form-select" id="basicSelect" name="packagetype_id">
                                            @foreach ($packageType as $value)
                                                <option value="{{ $value->id }}"
                                                    {{ $value->id == $package->packagetype_id ? 'selected' : '' }}>
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
                                        <input type="text" id="days" class="form-control" name="days"
                                            value="{{ $package->days }}" placeholder="days">
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
                                                    @if (isset($selectedMonths) && in_array($index + 1, $selectedMonths)) selected @endif>
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
                                        <input type="text" id="min_age" class="form-control" name="min_age"
                                            value="{{ $package->min_age }}" placeholder="Min Age">
                                    </div>
                                    @error('min_age')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="max_age">Max Age Limitation<span class="text-danger">*</span></label>
                                        <input type="text" id="max_age" class="form-control" name="max_age"
                                            value="{{ $package->max_age }}" placeholder="max age">
                                    </div>
                                    @error('max_age')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="days">Status</label>
                                        <select class="form-select" id="basicSelect" name="status">
                                            <option value="{{ $package->status }}">{{ $package->status }}</option>
                                            <option value="Active">Active</option>
                                            <option value="InActive">InActive</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="image" for="">Thumbnail<span
                                                class="text-danger">*</span></label>
                                        <!-- Display the existing image if available -->
                                        @if ($package->thumbnail)
                                            <div>
                                                <img id="imagePreview"
                                                    src="{{ asset('storage/' . $package->thumbnail) }}"
                                                    alt="Current Image" width="100" height="100">
                                            </div>
                                        @endif
                                        <input type="file" class="form-control" name="thumbnail" id="image">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="image" for="">Map Image<span
                                                class="text-danger">*</span></label>
                                        <!-- Display the existing image if available -->
                                        @if ($package->map_image)
                                            <div>
                                                <img id="mapPreview" src="{{ asset('storage/' . $package->map_image) }}"
                                                    alt="Current Image" width="100" height="100">
                                            </div>
                                        @endif
                                        <input type="file" class="form-control" name="map_image" id="map_image">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="">Description<span class="text-danger">*</span></label>
                                        <textarea name="description" id="editor" cols="30" rows="10">{{ old('description', $package->description ?? '') }}</textarea>
                                    </div>
                                    @error('description')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="default-acc">Accommodation Description<span
                                                class="text-danger">*</span></label>
                                        <textarea name="accommodation" id="editor1" cols="30" rows="10">{{ old('accommodation', $package->accommodation ?? '') }}</textarea>
                                    </div>
                                    @error('accommodation')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="default-inc">Package Includes<span
                                                class="text-danger">*</span></label>
                                        <textarea name="package_includes" id="editor2" cols="30" rows="10">{{ old('package_includes', $package->package_includes ?? '') }}</textarea>
                                    </div>
                                    @error('package_includes')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="default-inc">Inclusion<span class="text-danger">*</span></label>
                                        <textarea name="inclusion" id="editor3" cols="30" rows="10">{{ old('inclusion', $package->inclusion ?? '') }}</textarea>
                                    </div>
                                    @error('inclusion')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="default-inc">Exclusion<span class="text-danger">*</span></label>
                                        <textarea name="exclusion" id="editor4" cols="30" rows="10">{{ old('exclusion', $package->exclusion ?? '') }}</textarea>
                                    </div>
                                    @error('exclusion')
                                        <span class="text-danger" role="alert">*{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="default-inc">Itinerary<span class="text-danger">*</span></label>
                                        <textarea name="itinerary" id="editor5" cols="30" rows="10">{{ old('itinerary', $package->itinerary ?? '') }}</textarea>
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
        //preview Image
        function previewImage() {
            const file = document.getElementById('image').files[0];
            const reader = new FileReader();

            reader.onloadend = function() {
                document.getElementById('imagePreview').src = reader.result;
            }

            if (file) {
                reader.readAsDataURL(file); // This will trigger the onloadend event
            } else {
                document.getElementById('imagePreview').src = "#"; // Reset the preview if no file is selected
            }
        }

        //Validation script
        $(document).ready(function() {
            $('#createDrawDestination').validate({ // initialize the plugin
                rules: {
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
                    sub_title: {
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
                    accommodation: {
                        required: true
                    },
                    package_includes: {
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
                    }
                },
                // Customizing error messages
                messages: {
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
                    sub_title: {
                        required: 'Please enter the sub title.'
                    },
                    status: {
                        required: "Please select the status."
                    },
                    tax: {
                        required: 'Please enter the tax.'
                    },
                    packagetype_id: {
                        required: 'Please select the package type.'
                    },
                    accommodation: {
                        required: 'Please provide the accommodation.'
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
