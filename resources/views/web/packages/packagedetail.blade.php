@extends('layouts.app')
@section('content')
<div class="main">
    <!-- Package-Single -->
    <section class="package-single">
        <div class="container">
            <div class="package-single-inner">
       
                <div class="package-single-bottom">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="package-single-left">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="package-single-left-img">
                                            <figure>
                                                <img src="{{asset('web/assets/images/pool-one.png')}}" />
                                            </figure>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="package-single-left-img">
                                            <figure>
                                                <img src="{{asset('web/assets/images/pool-two.png')}}" />
                                            </figure>
                                            <div class="tree-img">
                                                <figure>
                                                    <img src="{{asset('web/assets/images/pool-three.png')}}" />
                                                </figure>
                                                <figcaption>+21 photos <i class="fa-solid fa-circle-arrow-right"></i></figcaption>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Overview -->
                                <div class="overview">
                                        <div class="overview-inner">
                                            <div class="overview-head">
                                                <h2>Overview</h2>
                                                <p>
                                                    On the western coast, Goa is known for its endless beaches, stellar nightlife, eclectic seafood, world-heritage listed architecture. Spread across just 3,942 km, Goa lies in the
                                                    Konkan region. It is a far cry from the hippie haven or a beach getaway, and one of the only few destinations that is open 24x7. Having been a Portuguese territory for almost 400
                                                    years, the Portuguese architecture is nowhere as prevalent as in Goa - visit one of the many whitewashed churches, crumbling forts or spectacular churches. The yellow houses with
                                                    purple doors, ochre coloured mansions and oyester shell windows is what completes the kalieodscope of Goan architecture
                                                </p>
                                            </div>
                                            <ul class="overview-bottom">
                                                <li>
                                                    <img src="{{asset('web/assets/images/airplane.png')}}" />
                                                    Flights
                                                </li>
                                                <li>
                                                    <img src="{{asset('web/assets/images/bed.png')}}" />
                                                    Hotel Stay
                                                </li>
                                                <li>
                                                    <img src="{{asset('web/assets/images/forkknife.png')}}" />
                                                    Meals
                                                </li>
                                                <li>
                                                    <img src="{{asset('web/assets/images/bus.png')}}" />
                                                    Transfers
                                                </li>
                                                <li>
                                                    <img src="{{asset('web/assets/images/path.png')}}" />
                                                    Sightseeing
                                                </li>
                                                <li>
                                                    <img src="{{asset('web/assets/images/boat.png')}}" />
                                                    Cruise
                                                </li>
                                            </ul>
                                        </div>
                                </div>
                                <!-- Info -->
                                <div class="info">
                                  <h2>Other Info</h2>
                                  <div class="info-inner">
                                    <div class="d-flex align-items-start">
                                      <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                        <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">Inclusion</button>

                                        <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">Exclusion</button>

                                        <button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">Cancellation Policy</button>

                                        <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">Important Note</button>

                                      </div>
                                      <div class="tab-content" id="v-pills-tabContent">
                                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab" tabindex="0">
                                          <ul class="info-content">
                                            <li><span><i class="fa-regular fa-circle-check"></i></span>MAP (Room + Breakfast + Dinner)</li>
                                            <li><span><i class="fa-regular fa-circle-check"></i></span>5 Nights Hotel Accommodation</li>
                                            <li><span><i class="fa-regular fa-circle-check"></i></span>Meals : 5 Breakfast , 5 Dinner</li>
                                            <li><span><i class="fa-regular fa-circle-check"></i></span>Pick up & drop facility</li>
                                            <li><span><i class="fa-regular fa-circle-check"></i></span>Sightseeing tour</li>
                                            <li><span><i class="fa-regular fa-circle-check"></i></span>Swimming pool access</li>
                                            <li><span><i class="fa-regular fa-circle-check"></i></span>Water sports activities ( Jet ski , Banana ride , Bumper ride , Parasailing, Scuba diving</li>
                                            <li><span><i class="fa-regular fa-circle-check"></i></span>Complimentary scuba diving video</li>
                                          </ul>
                                        </div>

                                        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab" tabindex="0">
                                             <div class="data-not">Data Not Found</div>
                                        </div>

                                        <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab" tabindex="0">
                                        <div class="data-not">Data Not Found</div>
                                      </div>

                                        <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab" tabindex="0">
                                             <div class="data-not">Data Not Found</div>
                                        </div>

                                      </div>
                                    </div>

                                  </div>
                                </div>
                                <!-- Guests -->
                                <div class="guests">
                                  <h2>See what guests loved the most:</h2>
                                  <div class="guests-inner">
                                      <div class="owl-carousel owl-theme guests-slider">
                                          <div class="item">
                                            <div class="guests-wapper">
                                              <div class="guests-wapper-head">
                                                <figure>
                                                  <img src="{{asset('web/assets/images/experience-one.png')}}">
                                                </figure>
                                                <h2>Yuvraj sharma</h2>
                                              </div>
                                              <p>I went for my honeymoon with Travel Agency. I discussed about my destination with akash and he shared an amazing itinerary which covered all the places of Goa which were a must visit during month of december. </p>
                                            </div>
                                          </div>
                                           <div class="item">
                                            <div class="guests-wapper">
                                              <div class="guests-wapper-head">
                                                <figure>
                                                  <img src="i{{asset('web/assets/mages/experience-two.png')}}">
                                                </figure>
                                                <h2>Suraj sharma</h2>
                                              </div>
                                              <p>I went for my honeymoon with Travel Agency. I discussed about my destination with akash and he shared an amazing itinerary which covered all the places of Goa which were a must visit during month of december. </p>
                                            </div>
                                          </div>
                                      </div>
                                  </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="package-single-right">
                                <div class="package-single-right-head">
                                    {{-- <h2>Paris & Normandy Cruise</h2> --}}
                                    <h2>{{$packages->name}}</h2>
                                    <div class="guest">
                                 
                                            <img src="{{asset('web/assets/images/timer.svg')}}" /><span>{{$packages->days}} Days</span>  </div>
                                </div>
                                <div class="package-single-right-middle">
                                  
                                    <div class="texes">
                                        {{-- <h4>$ 25 799.00</h4> --}}
                                        <h4>${{$packages->price}}</h4>
                                        <p><span>+₹</span>409 taxes & fees</p>
                                        <p><span>1 Room</span> per night</p>
                                        <p class="free">Free Cancellation till 22- May-2024</p>
                                    </div>
                                </div>
                                <a class="travel-btn" href="javascript::">Send Enquiry</a>
                            </div>



                            <div class="Package-Includes-main">
                               <ul>
                                <li> <img src="{{asset('web/assets/images/tick-circle.svg')}}" /> INTERNATIONAL FLIGHTS</li>
                                <li> <img src="{{asset('web/assets/images/tick-circle.svg')}}" /> WELCOME & TRANSFERS</li>
                                <li> <img src="{{asset('web/assets/images/tick-circle.svg')}}" /> HOTEL 4*</li>
                                <li> <img src="{{asset('web/assets/images/tick-circle.svg')}}" /> ALL BREAKFASTS + 1 LUNCH</li>
                                <li> <img src="{{asset('web/assets/images/tick-circle.svg')}}" /> EXCURSIONS</li>
                               </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection