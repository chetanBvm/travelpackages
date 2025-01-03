@php
    $title = 'My Vacay Host';
    $filename = 'Edit Bookings';
@endphp
@extends('admin.layouts.app')
@section('title', $title)
@section('filename', $filename)
@section('content')

    <div class="col-md-12 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Update status Bookings</h4>
                {{-- <a href="{{ route('bookings.index') }}" type="button" class="btn btn-info gray-btn d-lg-block m-l-15"><i
                        class="bi bi-caret-left-fill"></i><span>Back</span></a> --}}

            </div>
            {{-- action="{{ route('bookings.update', $bookings->id) }}" --}}
            <div class="card-content">
                <div class="card-body">
                    <form class="form form-vertical" method="post" enctype="multipart/form-data"
                        action="{{ route('admin.bookings.update', $bookings->id) }}" id="createDrawDestination">
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="days">Transaction Id</label>
                                        <input type="text" id="heading-vertical" class="form-control"
                                            name="transaction_id" placeholder="customer name"
                                            value="{{ old('transaction_id', $bookings->transaction_id ?? '') }}"
                                            maxlength="12" pattern="[A-Za-z\s]+"
                                            oninput="this.value = this.value.replace(/[^A-Za-z]/g, '')" readonly>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="days">Customer Name<span class="text-danger">*</span></label>
                                        <input type="text" id="heading-vertical" class="form-control"
                                            name="passenger_name" placeholder="customer name"
                                            value="{{ old('passenger_name', $bookings->passenger_name ?? '') }}"
                                            maxlength="12" pattern="[A-Za-z\s]+"
                                            oninput="this.value = this.value.replace(/[^A-Za-z]/g, '')">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="days">Customer Email<span class="text-danger">*</span></label>
                                        <input type="text" id="heading-vertical" class="form-control" name="c_email"
                                            placeholder="email" value="{{ old('c_email', $bookings->c_email ?? '') }}"
                                            maxlength="30" readonly>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="days">Contact No.<span class="text-danger">*</span></label>
                                        <input type="text" id="heading-vertical" class="form-control" name="phone"
                                            placeholder="contact no" value="{{ old('phone', $bookings->phone ?? '') }}"
                                            maxlength="30">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="days">Pacakage Name<span class="text-danger">*</span></label>
                                        <input type="text" id="heading-vertical" class="form-control" name="package_name"
                                            placeholder="package name"
                                            value="{{ old('package_name', $bookings->package_name ?? '') }}" maxlength="40">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="days">Departure City<span class="text-danger">*</span></label>
                                        <input type="text" id="heading-vertical" class="form-control"
                                            name="departure_city" placeholder="departure city"
                                            value="{{ old('departure_city', $bookings->departure_city ?? '') }}"
                                            maxlength="40" readonly>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="days">Departure Date<span class="text-danger">*</span></label>
                                        <input type="date" id="heading-vertical" class="form-control"
                                            name="departure_date" placeholder="departure date"
                                            value="{{ old('departure_date', $bookings->departure_date ?? '') }}"
                                            maxlength="40">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="days">Adult Passenger<span class="text-danger">*</span></label>
                                        <input type="number" id="heading-vertical" class="form-control"
                                            name="passengers_adult" placeholder="passenger adult"
                                            value="{{ old('passengers_adult', $bookings->passengers_adult ?? '') }}">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="days">Child Passenger</label>
                                        <input type="number" id="heading-vertical" class="form-control"
                                            name="passengers_children" placeholder="passenger child(Eg:1)"
                                            value="{{ old('passengers_children', $bookings->passengers_children ?? '') }}">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="days">Infant Passenger</label>
                                        <input type="number" id="heading-vertical" class="form-control"
                                            name="passengers_infant" placeholder="passenger infant(Eg:0)"
                                            value="{{ old('passengers_infant', $bookings->passengers_infant ?? '') }}">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="days">Room Description<span class="text-danger">*</span></label>
                                        <input type="text" id="heading-vertical" class="form-control"
                                            name="room_description" placeholder="room description"
                                            value="{{ old('room_description', $bookings->room_description ?? '') }}">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="price">Price<span class="text-danger">*</span></label>
                                        <input type="text" id="heading-vertical" class="form-control"
                                            name="tour_price" placeholder="price"
                                            value="{{ old('tour_price', $bookings->tour_price ?? '') }}"
                                            pattern="[0-9\s]+" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="days">Special Request</label>
                                        <input type="text" id="heading-vertical" class="form-control"
                                            name="special_requests" placeholder="special requests"
                                            value="{{ old('special_requests', $bookings->special_requests ?? '') }}">
                                    </div>
                                </div>

                                <div class="col-6 d-none" id="cancelReason">
                                    <div class="form-group">
                                        <label for="days">Cancel Reason</label>
                                        <input type="text" id="heading-vertical" class="form-control"
                                            name="cancellation_reason" placeholder="cancellation reason"
                                            value="{{ old('cancellation_reason', $bookings->cancellation_reason ?? '') }}">
                                    </div>
                                </div>

                                <div class="col-6 d-none" id="rejectReason">
                                    <div class="form-group">
                                        <label for="days">Reject Reason</label>
                                        <input type="text" id="heading-vertical" class="form-control"
                                            name="reject_reason" placeholder="reject reason"
                                            value="{{ old('reject_reason', $bookings->reject_reason ?? '') }}">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="days">Status</label>
                                        <select class="form-select" id="bookingStatus" name="status">
                                            <option value="{{ $bookings->status }}">{{ $bookings->status }}</option>
                                            <option value="Approved">Approved</option>
                                            <option value="Cancel">Cancelled</option>
                                            <option value="Rejected">Rejected</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                    <a href="{{ route('bookings.index') }}" type="button"
                                        class="btn btn-light-secondary me-1 mb-1"><span>Back</span></a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Rejection Reason Modal -->
    {{-- <div class="modal fade" id="rejectionModal" tabindex="-1" aria-labelledby="rejectionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rejectionModalLabel">Rejection Reason</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="rejectionReason">Reason</label>
                        <textarea id="rejectionReason" class="form-control" rows="3" placeholder="Enter rejection reason"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" id="rejectionSubmit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script>
        function toggleReasonInputs(selectedValue) {

            $('#cancelReason').addClass('d-none');
            $('#rejectReason').addClass('d-none');

            if (selectedValue === 'Cancel') {
                $('#cancelReason').removeClass('d-none');
            } else if (selectedValue === 'Rejected') {
                $('#rejectReason').removeClass('d-none');
            }
        }
        var currentStatus = $('#bookingStatus').val();
        toggleReasonInputs(currentStatus);

        // On change event, toggle inputs based on new selection
        $('#bookingStatus').on('change', function() {
            var selectedValue = $(this).val();
            toggleReasonInputs(selectedValue);
        });
    </script>
@endsection
