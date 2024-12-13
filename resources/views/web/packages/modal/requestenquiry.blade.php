<div class="enquiry-popuo-section">
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Request A Booking</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                {{-- <div class="padding30" id="errorBooking">Error</div> --}}
                <form name="modal-form" id="modal-form" method="post" action="{{route('booking.store')}}">
                    @csrf()
                    <input type="hidden" id="package_name" name="package_name" value="{{ $package->name }}">
                    <input type="hidden" id="package_id" name="package_id" value="{{ $package->id }}">
                    <input type="hidden" name="c_formName" value="booking">
                    <input type="hidden" name="c_currency" id="c_currency" value="{{ $currency }}">
                    <input type="hidden" name="departure_date" id="departure_date">

                    <div class="modal-body">
                        <h2>{{ $package->name }}</h2>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    {{-- <label for="exampleFormControlInput1" class="form-label">Departure City</label>

                                <input type="text" class="form-control" id="exampleFormControlInput1"
                                    placeholder="Los Angeles"> --}}
                                    <label for="exampleFormControlInput1" class="form-label">Departure City</label>
                                    <div class="Destination-form-data selection-country">
                                        <input type="text" class="form-control departure_city" placeholder="" value="" name="departure_city">
                                        {{-- <select class="form-select" aria-label="Default select example"
                                            name="departure_city" id="airport_code"> --}}
                                            {{-- @foreach ($data['airport'] as $airport)
                                                <option value="{{ $airport->id }}">{{ $airport->name }}</option>
                                            @endforeach --}}
                                            {{-- <option value="1" selected>1 adult</option>
                                            <option value="2">6-9 Days</option>
                                            <option value="3">10-15 Days</option>
                                            <option value="4">16-21 Days</option> --}}
                                        {{-- </select> --}}
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Accommodation</label>
                                    <select class="form-select" aria-label="Default select example" name="category">
                                        <option value="classic Hotels">Classic Hotels</option>
                                        <option value="superior Hotels">Superior Hotels</option>
                                    </select>
                                    {{-- <input type="date" class="form-control departure_date" id="date"> --}}
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Date</label>
                                    <input type="date" class="form-control departure_date" id="date">
                                </div>
                            </div>
                        </div>

                        <div class="select-data-popup">
                            <h2>How many passengers are you?</h2>
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="Destination-form-data mb-3">
                                        <select class="form-select" name= "passengers_adult" id="passengers_adult"
                                            aria-label="Default select example">
                                            <option value="1">1 adult</option>
                                            <option value="2" selected>2 adult</option>
                                            <option value="3">3 adult</option>
                                            <option value="4">4 adult</option>
                                            <option value="5">5 adult</option>
                                            <option value="6">6 adult</option>
                                            <option value="7">7 adult</option>
                                            <option value="8">8 adult</option>
                                            <option value="9">9 adult</option>
                                            <option value="10">10 +(Group request)</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="Destination-form-data mb-3">
                                        <select class="form-select" name="passengers_children" id="passengers_children"
                                            aria-label="Default select example">
                                            <option value="0" selected>0 child (2-11)</option>
                                            <option value="1">1 child (2-11)</option>
                                            <option value="2">2 child (2-11)</option>
                                            <option value="3">3 child (2-11)</option>
                                            <option value="4">4 child (2-11)</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="Destination-form-data mb-3">
                                        <select class="form-select" name="passengers_infant"id="passengers_infant"
                                            aria-label="Default select example">
                                            <option value="0" selected>0 infant (<2)< /option>
                                            <option value="1">1 infant (<2)< /option>
                                            <option value="2">2 infants (<2)< /option>
                                            <option value="3">3 infants (<2)< /option>
                                            <option value="4">4 infants (<2)< /option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="Destination-form-data mb-3">
                                        <select class="form-select" name="room_occupancy"
                                            id="room_occupancy"aria-label="Default select example"> 
                                            <option value="1" selected>1 ROOM (1 Double)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h2>Your contact information</h2>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Full Name</label>
                                    <input type="text" class="form-control" name="passenger_name"
                                        id="exampleFormControlInput1" placeholder="Enter your name" required>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Mobile Number</label>
                                    <div class="mobile-number-inner">
                                        <select class="form-select" aria-label="Default select example"
                                            name="phone_code" id="phone">
                                            <option value="+91" selected>+91</option>
                                            <option value="+55">+55</option>
                                            <option value="+81">+81</option>
                                            <option value="+82">+82</option>
                                        </select>
                                        <input type="text" class="form-control" id="exampleFormControlInput1" name="phone"
                                            placeholder="Enter mobile number">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Email Address</label>
                                    <input type="text" class="form-control" name="c_email"
                                        id="exampleFormControlInput1" placeholder="Enter email address">
                                </div>
                            </div>
                        </div>

                        <div class="body-footer-data">
                            <p>You will receive a detailed quote, to which you will be able to reply with any questions
                                or
                                requests you may have. An agent will be assigned to you.</p>
                            <div id="terms-error" style="font-size:14px;padding-bottom:5px;"></div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" checked id="signup"
                                    name="signup" value="1">
                                <label class="form-check-label" for="signup">
                                    I agree to be contacted by email with a follow-up to my request and receive other
                                    great
                                    deals.
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" id="sbmBooking">
                        <input class="travel-btn btn" type="submit" id="submit_search" value="Submit Request">
                        {{-- <button class="travel-btn btn" type="button" id="submit_search">Submit Request</button> --}}
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
