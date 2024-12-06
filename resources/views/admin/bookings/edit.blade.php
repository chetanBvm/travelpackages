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
                <a href="{{ route('bookings.index') }}" type="button" class="btn btn-info gray-btn d-lg-block m-l-15"><i
                        class="bi bi-caret-left-fill"></i><span>Back</span></a>

            </div>
            {{-- action="{{ route('bookings.update', $bookings->id) }}" --}}
            <div class="card-content">
                <div class="card-body">
                    <form class="form form-vertical" id="submit-form" method="post" enctype="multipart/form-data"
                        action="{{ route('admin.bookings.update', $bookings->id) }}" id="createDrawDestination">
                        @csrf
                        {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> --}}
                        <div class="form-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="days">Status</label>
                                        <select class="form-select" id="bookingStatus" name="status">
                                            <option value="{{ $bookings->status }}">{{ $bookings->status }}</option>
                                            <option value="Booking">Booking</option>
                                            <option value="Approved">Approved</option>
                                            <option value="Cancel">Cancelled</option>
                                            <option value="rejected">Rejected</option>
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

    <!-- Rejection Reason Modal -->
    <div class="modal fade" id="rejectionModal" tabindex="-1" aria-labelledby="rejectionModalLabel" aria-hidden="true">
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
    </div>

@endsection
@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#submit-form').on('submit', function(e) {
                e.preventDefault(); // Prevent the default form submission

                const selectedStatus = $('#bookingStatus').val();

                if (selectedStatus === 'rejected') {
                    // Open the rejection reason modal
                    $('#rejectionModal').modal('show');
                } else {
                    // Submit the form for other statuses
                    submitBookingForm({
                        status: selectedStatus
                    });
                }
            });

            // Handle rejection reason modal submission
            $('#rejectionSubmit').on('click', function() {
                const reason = $('#rejectionReason').val();
                if (reason.trim() === '') {
                    alert('Please provide a rejection reason.');
                    return;
                }

                // Close the modal and submit the form with rejection reason
                $('#rejectionModal').modal('hide');
                submitBookingForm({
                    status: 'rejected',
                    reason: reason,
                });
            });

            function submitBookingForm(data) {

                const formData = data.status;
                const formReason = data.reason;
                // const form = document.getElementById('submit-form');

                // const formData = new FormData(form);

                // Add custom data like reason (if any)
                // for (const key in data) {
                //     formData.append(key, data[key]);
                // }

                $.ajax({
                    url: $('#submit-form').attr('action'),
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                            'content'), // Ensure meta tag exists
                    },
                    data: {
                        formData: formData,
                        reason : formReason,
                        "_token": "{{ csrf_token() }}"
                    },

                    success: function(response) {
                        if (response.success) {
                            Swal.fire(
                                'Approved!',
                                'Booking approved successfully!',
                                'success'
                            )
                            location.reload(); // Refresh the page after success
                        } else {
                            // console.log(response);

                            alert('Error: ' + response.message);
                        }
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                        alert('An error occurred while updating the booking status.');
                    },
                });
            }
        });
    </script>
@endsection
