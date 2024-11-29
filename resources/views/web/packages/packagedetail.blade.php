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
                                                    <img src="{{ asset('web/assets/images/pool-one.png') }}" />
                                                </figure>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="package-single-left-img">
                                                <figure>
                                                    <img src="{{ asset('web/assets/images/pool-two.png') }}" />
                                                </figure>
                                                <div class="tree-img">
                                                    <figure>
                                                        <img src="{{ asset('web/assets/images/pool-three.png') }}" />
                                                    </figure>
                                                    <figcaption>+21 photos <i class="fa-solid fa-circle-arrow-right"></i>
                                                    </figcaption>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- tab-section -->

                                    <div class="package-details-tabs">

                                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link active" id="pills-dateprice-tab"
                                                    data-bs-toggle="pill" data-bs-target="#pills-dateprice" type="button"
                                                    role="tab" aria-controls="pills-dateprice"
                                                    aria-selected="true">Dates & Prices</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="pills-Itinerary-tab" data-bs-toggle="pill"
                                                    data-bs-target="#pills-Itinerary" type="button" role="tab"
                                                    aria-controls="pills-Itinerary" aria-selected="false">Itinerary</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="pills-Accommodation-tab" data-bs-toggle="pill"
                                                    data-bs-target="#pills-Accommodation" type="button" role="tab"
                                                    aria-controls="pills-Accommodation"
                                                    aria-selected="false">Accommodation</button>
                                            </li>

                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link " id="pills-Inclusions-tab" data-bs-toggle="pill"
                                                    data-bs-target="#pills-Inclusions" type="button" role="tab"
                                                    aria-controls="pills-Inclusions"
                                                    aria-selected="true">Inclusions/Exclusions</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="pills-Map-tab" data-bs-toggle="pill"
                                                    data-bs-target="#pills-Map" type="button" role="tab"
                                                    aria-controls="pills-Map" aria-selected="false">Map</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="pills-FAQ-tab" data-bs-toggle="pill"
                                                    data-bs-target="#pills-FAQ" type="button" role="tab"
                                                    aria-controls="pills-FAQ" aria-selected="false">FAQ</button>
                                            </li>
                                        </ul>

                                    </div>


                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="package-single-right">
                                    <div class="package-single-right-head">
                                        {{$packages->name}}
                                        {{-- <h2>Paris & Normandy Cruise</h2> --}}
                                        <div class="guest">

                                            <img src="{{ asset('web/assets/images/timer.svg') }}" /><span>{{$packages->days}} Days</span>
                                        </div>
                                    </div>
                                    <div class="package-single-right-middle">

                                        <div class="texes">
                                            <h4>$ 25 799.00</h4>
                                            <p><span>+₹</span>409 taxes & fees</p>
                                            <p><span>1 Room</span> per night</p>
                                            <p class="free">Free Cancellation till 22- May-2024</p>
                                        </div>
                                    </div>
                                    <a class="travel-btn" href="javascript::">Send Enquiry</a>
                                </div>



                                <div class="Package-Includes-main">
                                    <h2>Package Includes</h2>
                                    <ul>
                                        <li> <img src="{{ asset('web/assets/images/tick-circle.svg') }}" /> INTERNATIONAL
                                            FLIGHTS</li>
                                        <li> <img src="{{ asset('web/assets/images/tick-circle.svg') }}" /> WELCOME &
                                            TRANSFERS</li>
                                        <li> <img src="{{ asset('web/assets/images/tick-circle.svg') }}" /> HOTEL 4*</li>
                                        <li> <img src="{{ asset('web/assets/images/tick-circle.svg') }}" /> ALL BREAKFASTS +
                                            1 LUNCH</li>
                                        <li> <img src="{{ asset('web/assets/images/tick-circle.svg') }}" /> EXCURSIONS</li>
                                    </ul>

                                    <div class="coupon-main">
                                        <div class="coupon-left">
                                            <div class="coupon-top">
                                                <span>PROMO: $100 off</span>
                                                <span>$2098.00</span>
                                            </div>
                                            <h3>CAD$ <span>1,998*</span></h3>
                                            <p>STARTING AT PER PERSON/TAXES INCL</p>
                                        </div>
                                        <div class="coupon-right">
                                            <span>OFF</span>
                                            <span>20%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="tab-result-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="tab-content" id="pills-tabContent">


                            <div class="tab-pane fade show active" id="pills-dateprice" role="tabpanel"
                                aria-labelledby="pills-dateprice-tab" tabindex="0">
                                <div class="heading-main">
                                    <h2>Dates & Prices</h2>
                                </div>

                                <div class="package-details-filters">
                                    <form action="" class="row">

                                        <div class="col-lg-7">

                                            <div class="Destination-form">



                                                <div class="Destination-form-data">
                                                    <label class="form-label">Departure City :</label>
                                                    <select class="form-select" id="mySelect"
                                                        aria-label="Default select example">
                                                        <option value="1" selected>Los Angeles</option>
                                                        <option value="2">6-9 Days</option>
                                                        <option value="3">10-15 Days</option>
                                                        <option value="4">16-21 Days</option>
                                                    </select>
                                                </div>



                                                <div class="Destination-form-data">
                                                    <label class="form-label">Month:</label>
                                                    <select class="form-select" id="mySelectDeparture"
                                                        aria-label="Default select example">
                                                        <option selected>All Months</option>
                                                        <option value="1">Nov 2024</option>
                                                        <option value="2">Dec 2024</option>
                                                        <option value="3">Jan 2025</option>
                                                        <option value="4">Feb 2025</option>
                                                        <option value="5">Mar 2025</option>
                                                        <option value="6">Apr 2025</option>
                                                        <option value="7">May 2025</option>
                                                    </select>


                                                </div>

                                                <div class="Destination-form-data">
                                                    <label class="form-label">Accommodation Category :</label>
                                                    <select class="form-select" id="mySelectLength"
                                                        aria-label="Default select example">
                                                        <option selected>Main Deck</option>
                                                        <option value="1">6-9 Days</option>
                                                        <option value="2">10-15 Days</option>
                                                        <option value="3">16-21 Days</option>
                                                        <option value="4">22+ Days</option>
                                                    </select>


                                                </div>


                                            </div>

                                        </div>

                                    </form>
                                </div>



                                <div class="ticket-details-main">
                                    <div class="ticket-date-name">
                                        <h3>April 2025</h3>
                                        <span>Ms. Renoir - Premium ship</span>
                                    </div>

                                    <div class="ticket-details-bottom-main">
                                        <div class="ticket-details-bottom-inner">
                                            <div class="ticket-detail-bottom-data">
                                                <span><img src="{{ asset('web/assets/images/airplane.svg') }}">Departure
                                                    Date</span>
                                                <h4>Fri Apr 11</h4>
                                            </div>
                                            <div class="ticket-detail-bottom-data">
                                                <span><img src="{{ asset('web/assets/images/aroplan-bt.svg') }}">Departure
                                                    Date</span>
                                                <h4>Fri Apr 11</h4>
                                            </div>
                                            <div class="ticket-detail-bottom-data">
                                                <span><img
                                                        src="{{ asset('web/assets/images/starting-price.svg') }}">Departure
                                                    Date</span>
                                                <div class="price-details-data">
                                                    <span>$3698</span>
                                                    <h4>$3,598<span>/person</span></h4>
                                                </div>
                                            </div>


                                        </div>
                                        <div class="ticket-details-right-data">
                                            <div class="offers-data">
                                                <span>100$ off</span>
                                            </div>
                                            <div class="enquiry-btn">
                                                <a class="travel-btn" href="javascript::">Send Enquiry</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ticket-details-bottom-main">
                                        <div class="ticket-details-bottom-inner">
                                            <div class="ticket-detail-bottom-data">
                                                <span><img src="{{ asset('web/assets/images/airplane.svg') }}">Departure
                                                    Date</span>
                                                <h4>Sat Apr 13</h4>
                                            </div>
                                            <div class="ticket-detail-bottom-data">
                                                <span><img src="{{ asset('web/assets/images/aroplan-bt.svg') }}">Departure
                                                    Date</span>
                                                <h4>Mon Apr 28</h4>
                                            </div>
                                            <div class="ticket-detail-bottom-data">
                                                <span><img
                                                        src="{{ asset('web/assets/images/starting-price.svg') }}">Departure
                                                    Date</span>
                                                <div class="price-details-data">
                                                    <span>$3698</span>
                                                    <h4>$3,598<span>/person</span></h4>
                                                </div>
                                            </div>


                                        </div>
                                        <div class="ticket-details-right-data">
                                            <div class="offers-data">
                                                <span>100$ off</span>
                                            </div>
                                            <div class="enquiry-btn">
                                                <a class="travel-btn" href="javascript::">Send Enquiry</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ticket-details-bottom-main">
                                        <div class="ticket-details-bottom-inner">
                                            <div class="ticket-detail-bottom-data">
                                                <span><img src="{{ asset('web/assets/images/airplane.svg') }}">Departure
                                                    Date</span>
                                                <h4>Fri Apr 11</h4>
                                            </div>
                                            <div class="ticket-detail-bottom-data">
                                                <span><img src="{{ asset('web/assets/images/aroplan-bt.svg') }}">Departure
                                                    Date</span>
                                                <h4>Fri Apr 11</h4>
                                            </div>
                                            <div class="ticket-detail-bottom-data">
                                                <span><img
                                                        src="{{ asset('web/assets/images/starting-price.svg') }}">Departure
                                                    Date</span>
                                                <div class="price-details-data">
                                                    <span>$3698</span>
                                                    <h4>$3,598<span>/person</span></h4>
                                                </div>
                                            </div>


                                        </div>
                                        <div class="ticket-details-right-data">
                                            <div class="offers-data">
                                                <span>100$ off</span>
                                            </div>
                                            <div class="enquiry-btn">
                                                <a class="travel-btn" href="javascript::">Send Enquiry</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="ticket-details-main">
                                    <div class="ticket-date-name">
                                        <h3>July 2025</h3>
                                        <span>MS Seine Princess - Standard ship</span>
                                    </div>

                                    <div class="ticket-details-bottom-main">
                                        <div class="ticket-details-bottom-inner">
                                            <div class="ticket-detail-bottom-data">
                                                <span><img src="{{ asset('web/assets/images/airplane.svg') }}">Departure
                                                    Date</span>
                                                <h4>Fri Apr 11</h4>
                                            </div>
                                            <div class="ticket-detail-bottom-data">
                                                <span><img src="{{ asset('web/assets/images/aroplan-bt.svg') }}">Departure
                                                    Date</span>
                                                <h4>Fri Apr 11</h4>
                                            </div>
                                            <div class="ticket-detail-bottom-data">
                                                <span><img
                                                        src="{{ asset('web/assets/images/starting-price.svg') }}">Departure
                                                    Date</span>
                                                <div class="price-details-data">
                                                    <span>$3698</span>
                                                    <h4>$3,598<span>/person</span></h4>
                                                </div>
                                            </div>


                                        </div>
                                        <div class="ticket-details-right-data">
                                            <div class="offers-data">
                                                <span>100$ off</span>
                                            </div>
                                            <div class="enquiry-btn">
                                                <a class="travel-btn" href="javascript::">Send Enquiry</a>
                                            </div>
                                        </div>
                                    </div>


                                </div>



                                <div class="ticket-details-main">
                                    <div class="ticket-date-name">
                                        <h3>September 2025</h3>
                                        <span>MS Botticelli - Standard ship</span>
                                    </div>

                                    <div class="ticket-details-bottom-main">
                                        <div class="ticket-details-bottom-inner">
                                            <div class="ticket-detail-bottom-data">
                                                <span><img src="{{ asset('web/assets/images/airplane.svg') }}">Departure
                                                    Date</span>
                                                <h4>Fri Apr 11</h4>
                                            </div>
                                            <div class="ticket-detail-bottom-data">
                                                <span><img src="{{ asset('web/assets/images/aroplan-bt.svg') }}">Departure
                                                    Date</span>
                                                <h4>Fri Apr 11</h4>
                                            </div>
                                            <div class="ticket-detail-bottom-data">
                                                <span><img
                                                        src="{{ asset('web/assets/images/starting-price.svg') }}">Departure
                                                    Date</span>
                                                <div class="price-details-data">
                                                    <span>$3698</span>
                                                    <h4>$3,598<span>/person</span></h4>
                                                </div>
                                            </div>


                                        </div>
                                        <div class="ticket-details-right-data">
                                            <div class="offers-data">
                                                <span>100$ off</span>
                                            </div>
                                            <div class="enquiry-btn">
                                                <a class="travel-btn" href="javascript::">Send Enquiry</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ticket-details-bottom-main">
                                        <div class="ticket-details-bottom-inner">
                                            <div class="ticket-detail-bottom-data">
                                                <span><img src="{{ asset('web/assets/images/airplane.svg') }}">Departure
                                                    Date</span>
                                                <h4>Sat Apr 13</h4>
                                            </div>
                                            <div class="ticket-detail-bottom-data">
                                                <span><img src="{{ asset('web/assets/images/aroplan-bt.svg') }}">Departure
                                                    Date</span>
                                                <h4>Mon Apr 28</h4>
                                            </div>
                                            <div class="ticket-detail-bottom-data">
                                                <span><img
                                                        src="{{ asset('web/assets/images/starting-price.svg') }}">Departure
                                                    Date</span>
                                                <div class="price-details-data">
                                                    <span>$3698</span>
                                                    <h4>$3,598<span>/person</span></h4>
                                                </div>
                                            </div>


                                        </div>
                                        <div class="ticket-details-right-data">
                                            <div class="offers-data">
                                                <span>100$ off</span>
                                            </div>
                                            <div class="enquiry-btn">
                                                <a class="travel-btn" href="javascript::">Send Enquiry</a>
                                            </div>
                                        </div>
                                    </div>

                                </div>



                                <div class="ticket-details-main">
                                    <div class="ticket-date-name">
                                        <h3>October 2025</h3>
                                        <span>MS Botticelli - Standard ship</span>
                                    </div>

                                    <div class="ticket-details-bottom-main">
                                        <div class="ticket-details-bottom-inner">
                                            <div class="ticket-detail-bottom-data">
                                                <span><img src="{{ asset('web/assets/images/airplane.svg') }}">Departure
                                                    Date</span>
                                                <h4>Fri Apr 11</h4>
                                            </div>
                                            <div class="ticket-detail-bottom-data">
                                                <span><img src="{{ asset('web/assets/images/aroplan-bt.svg') }}">Departure
                                                    Date</span>
                                                <h4>Fri Apr 11</h4>
                                            </div>
                                            <div class="ticket-detail-bottom-data">
                                                <span><img
                                                        src="{{ asset('web/assets/images/starting-price.svg') }}">Departure
                                                    Date</span>
                                                <div class="price-details-data">
                                                    <span>$3698</span>
                                                    <h4>$3,598<span>/person</span></h4>
                                                </div>
                                            </div>


                                        </div>
                                        <div class="ticket-details-right-data">
                                            <div class="offers-data">
                                                <span>100$ off</span>
                                            </div>
                                            <div class="enquiry-btn">
                                                <a class="travel-btn" href="javascript::">Send Enquiry</a>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <div class="bottom-para">
                                    <p>*The advertised starting rate is available from Toronto on Jan 2025</p>
                                    <p>**All prices are subject to change without notice</p>
                                </div>
                            </div>


                            <div class="tab-pane fade" id="pills-Itinerary" role="tabpanel"
                                aria-labelledby="pills-Itinerary-tab" tabindex="0">
                                <div class="heading-main">
                                    <div class="heading-inner">
                                        <h2>AZORES ESCAPE</h2>
                                        <p>11 Days</p>
                                    </div>
                                    <div class="heading-main-right">
                                        <div class="download-data">
                                            <img src="{{ asset('web/assets/images/download.svg') }}">
                                            <span>Package Details</span>
                                        </div>
                                        <a class="travel-btn btn" href="javascript::">See Dates and Prices</a>
                                    </div>
                                </div>



                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="itinerary-inner">
                                            <h2>Day 1: Canada – Ponta Delgada (Azores, Portugal)</h2>
                                            <p>Flight with a good itinerary.</p>
                                            <h2>Day 2: Ponta Delgada</h2>
                                            <p>Upon arrival at the airport in Ponta Delgada, transfer to your hotel. The
                                                rest of the day is free for you to start your exploration of São Miguel, the
                                                biggest island of the volcanic archipelago of the Azores. Sao Miguel is also
                                                known as the ‘Green Island’ thanks to its diverse scenery. Overnight at your
                                                hotel in Ponta Delgada.</p>
                                            <h2>Day 3: Ponta Delgada – Whale Watching tour*</h2>
                                            <p>Breakfast at the hotel before making your way to the pier of Picos de
                                                Aventura, located at approx. 15 min walk from your hotel. Upon your arrival
                                                at the pier, you will embark on a beautiful experience to see some whales in
                                                the Atlantic Ocean. The Azores archipelago is an oasis of sea life, as 27
                                                species of cetaceans can be observed throughout the year. While on board,
                                                you will be accompanied by a professional team of marine biologist, and
                                                learn about the animals you see, their yearly migration routes and much
                                                more. You will return to the pier at the end of the tour and will have the
                                                rest of the day at your leisure. Overnight at your hotel in Ponta Delgada.
                                                (Breakfast)</p>
                                            <p>*Please be advised that we cannot guarantee the sighting of whales during the
                                                excursion.</p>
                                            <h2>Day 4: Ponta Delgada</h2>
                                            <p>Breakfast at the hotel. Day at leisure in the heart of Ponta Delgada. Ponta
                                                Delgada, the main city of the island of Sao Miguel, is known for its
                                                charming cobblestone streets, old architecture, colorful houses and coffee
                                                shops. You can stroll the Avenida Infante Dom Henrique, the harbor front
                                                promenade and discover the historical quarter, before heading to the chapel
                                                of Nossa Senhora da Esperança, one of the most visited places in Ponta
                                                Delgada. On the same square, you can visit a little old gem: The church of
                                                Igreja de São José. During this day, you can also discover Portas da Cidade,
                                                the Largo da Matriz, the museum of Carlos Machado and Sao Sebastiao parish
                                                church. Overnight at your hotel in Ponta Delgada. (Breakfast)</p>
                                            <h2>Day 5: Ponta Delgada – Lagoa do Fogo & Ribeira Grande</h2>
                                            <p>Following breakfast at the hotel, you will be embarking on a half-day tour
                                                towards the south coast. Your first stop will be Pica da Barrosa where you
                                                will have a beautiful view of Lagoa do Fogo, the ‘Lake of Fire’. This is the
                                                highest elevated lake on Sao Miguel Island and is a crater lake within the
                                                Agua de Pau Massif stratovolcano in the center of the island. You will then
                                                take the direction of Ribeira Grande, where you can admire the local
                                                architecture and get the chance to taste some of their traditional liquors.
                                                At the end of the tour, you will head back to your hotel. You will enjoy the
                                                rest of your day visiting the city. the city. Overnight in Ponta Delgada.
                                                (Breakfast)</p>
                                            <h2>Day 6: Ponta Delgada & Sete Cidades</h2>
                                            <p>Following breakfast at your hotel, you will start your tour with a visit to a
                                                pineapple plantation and a tasting of its liquor. You will then continue
                                                towards Pico do Carvão, where you will see the central part of the island
                                                and simultaneously see the north and south coasts of São Miguel. Upon
                                                reaching the parish of Sete Cidades, you will stop on the edge of Lagoa das
                                                Sete Cidades where you can enjoy a beautiful view of the blue lagoon. On the
                                                way up to the Vista do Rei viewpoint, you will admire Lagoa de Santiago,
                                                known for its peacefulness. You will then finally reach the viewpoint, where
                                                you will have a different perspective on the volcanic crater of Sete
                                                Cidades. You will then return to your hotel and have the rest of the day at
                                                leisure. Overnight at your hotel in Ponta Delgada. (Breakfast)</p>
                                            <h2>Day 7: Ponta Delgada - Furnas</h2>
                                            <p>Breakfast at your hotel. Today you will depart toward the southern part of
                                                the island to reach the first capital of Sao Miguel: Vila Franca do Campo.
                                                You will then continue to the interior of the Furnas valley, where you will
                                                visit Terra Nostra Park, a must-see on the island. While walking through the
                                                park, you will encounter various species of vegetation from all over the
                                                world, before relaxing in the geothermal pool of the park. Once the visit is
                                                over, you will head to Lagoa das Furnas for a truly unique experience. You
                                                will witness a traditional meal called ‘the Cozido das Furnas ‘cooked by a
                                                volcano before heading for lunch at a local restaurant to taste it. You will
                                                continue your tour with a walk on the site where we can find fumaroles and
                                                taste carbonated mineral waters (Água Azeda). The return to Ponta Delgada
                                                will be made by the north coast, passing through the Pico do Ferro
                                                viewpoint. On your way to Ponta Delgada, you will stop by the Gorreana tea
                                                factory to visit the oldest tea plantation in Europe. Evening at leisure and
                                                overnight at your hotel in Ponta Delgada. (Breakfast - Lunch)</p>
                                            <p>*Please note that the Thermal Tank at Park Terra Nostra is under construction
                                                until February 2025. All other areas and experiences remain accessible.</p>
                                            <h2>Day 8: Ponta Delgada</h2>
                                            <p>Breakfast at the hotel. Day at leisure to continue your exploration of Ponta
                                                Delgada. You can go discover the Gruta do Carvao, a geological formation of
                                                volcanic origin with a local guide, or opt for one of the optional tours
                                                available at the hotel desk. Overnight at your hotel in Ponta Delgada.
                                                (Breakfast)</p>
                                            <h2>Day 9: Ponta Delgada - Canada</h2>
                                            <p>After breakfast at the hotel, enjoy some free time to wander around Ponta
                                                Delgada before the transfer to the airport for your flight home. (Breakfast)
                                            </p>
                                            <p>-End of services-  </p>
                                            <p>*Please note*  </p>
                                            <p>The order of the excursions is subject to change.</p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane fade" id="pills-Accommodation" role="tabpanel"
                                aria-labelledby="pills-Accommodation-tab" tabindex="0">
                                <div class="heading-main">
                                    <div class="heading-inner">
                                        <h2>AZORES ESCAPE</h2>

                                    </div>
                                    <div class="heading-main-right">
                                        <a class="travel-btn btn" href="javascript::">See Dates and Prices</a>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="itinerary-inner">
                                            <p>Experience a comfortable stay in our Classic Hotels, carefully chosen for
                                                their value, convenient locations, and proximity to major attractions. Relax
                                                in well-maintained rooms with thoughtful amenities, savor a variety of
                                                breakfast choices, and benefit from attentive service to enhance your travel
                                                experience.</p>
                                            <p>• 7 nights in Ponta Delgada at the Sao Miguel Park 4* hotel (or similar) in a
                                                standard room</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="accommodation-images">
                                                <figure>
                                                    <img src="{{ asset('web/assets/images/Accommodation1.jpg') }}">
                                                </figure>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="accommodation-images">
                                                <figure>
                                                    <img src="{{ asset('web/assets/images/Accommodation2.jpg') }}">
                                                </figure>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="accommodation-images">
                                                <figure>
                                                    <img src="{{ asset('web/assets/images/Accommodation3.jpg') }}">
                                                </figure>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="tree-img accommodation-images">
                                                <figure>
                                                    <img src="{{ asset('web/assets/images/Accommodation4.jpg') }}">
                                                </figure>
                                                <figcaption>+21 photos <i class="fa-solid fa-circle-arrow-right"></i>
                                                </figcaption>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <div class="tab-pane fade" id="pills-Inclusions" role="tabpanel"
                                aria-labelledby="pills-Inclusions-tab" tabindex="0">
                                <div class="heading-main">
                                    <div class="heading-inner">
                                        <h2>INCLUDES</h2>

                                    </div>
                                    <div class="heading-main-right">
                                        <a class="travel-btn btn" href="javascript::">See Dates and Prices</a>
                                    </div>
                                </div>

                                <div class="inclusions-data">
                                    <ul>
                                        <li> <img src="{{ asset('web/assets/images/tick-circle.svg') }}">Round-trip
                                            international flights between
                                            Canada / Ponta Delgada with a good itinerary</li>
                                        <li> <img src="{{ asset('web/assets/images/tick-circle.svg') }}"> Welcome and
                                            transfers between the airports
                                            and the hotel in Ponta Delgada</li>
                                        <li> <img src="{{ asset('web/assets/images/tick-circle.svg') }}"> 7 nights hotel
                                            accommodations</li>
                                        <li> <img src="{{ asset('web/assets/images/tick-circle.svg') }}"> All breakfasts +
                                            1 lunch</li>
                                        <li> <img src="{{ asset('web/assets/images/tick-circle.svg') }}"> Multilingual
                                            English-speaking guide during
                                            the tours</li>
                                        <li> <img src="{{ asset('web/assets/images/tick-circle.svg') }}"> Three-hours
                                            whale
                                            watching boat tour</li>
                                        <li> <img src="{{ asset('web/assets/images/tick-circle.svg') }}"> All taxes, fees,
                                            and OPC</li>
                                    </ul>

                                    <h2>EXCLUDES</h2>
                                    <ul>
                                        <li> <img src="{{ asset('web/assets/images/tick-circle.svg') }}"> Travel insurance
                                        </li>
                                        <li> <img src="{{ asset('web/assets/images/tick-circle.svg') }}"> Fees for checked
                                            baggage</li>
                                        <li> <img src="{{ asset('web/assets/images/tick-circle.svg') }}"> Tips: Guides,
                                            bus drivers and hotel staff
                                        </li>
                                        <li> <img src="{{ asset('web/assets/images/tick-circle.svg') }}"> Meals and
                                            beverages unless otherwise
                                            mentioned</li>
                                        <li> <img src="{{ asset('web/assets/images/tick-circle.svg') }}"> Personal
                                            expenses and optional activities
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-Map" role="tabpanel" aria-labelledby="pills-Map-tab"
                                tabindex="0">
                                <div class="map-image">
                                    <img src="{{ asset('web/assets/images/map-image.jpg') }}">
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-FAQ" role="tabpanel" aria-labelledby="pills-FAQ-tab"
                                tabindex="0">
                                <div class="heading-main">
                                    <h2>Frequently Asked Questions</h2>
                                </div>


                                <div class="faq-data">
                                    <div class="accordion" id="accordionExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#collapseOne" aria-expanded="true"
                                                    aria-controls="collapseOne">
                                                    How much of a deposit is required?
                                                </button>
                                            </h2>
                                            <div id="collapseOne" class="accordion-collapse collapse show"
                                                data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    Lorem Ipsum has been the industry's standard dummy text ever since the
                                                    1500s, when an unknown printer took a galley of type and scrambled it to
                                                    make a type specimen book. It has survived not only five centuries, but
                                                    also the leap into electronic typesetting, remaining essentially
                                                    unchanged. </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                                    aria-expanded="false" aria-controls="collapseTwo">
                                                    When is the balance due?
                                                </button>
                                            </h2>
                                            <div id="collapseTwo" class="accordion-collapse collapse"
                                                data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    Lorem Ipsum has been the industry's standard dummy text ever since the
                                                    1500s, when an unknown printer took a galley of type and scrambled it to
                                                    make a type specimen book. It has survived not only five centuries, but
                                                    also the leap into electronic typesetting, remaining essentially
                                                    unchanged. </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                                    aria-expanded="false" aria-controls="collapseThree">
                                                    What is the group size?
                                                </button>
                                            </h2>
                                            <div id="collapseThree" class="accordion-collapse collapse"
                                                data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    Lorem Ipsum has been the industry's standard dummy text ever since the
                                                    1500s, when an unknown printer took a galley of type and scrambled it to
                                                    make a type specimen book. It has survived not only five centuries, but
                                                    also the leap into electronic typesetting, remaining essentially
                                                    unchanged. </div>
                                            </div>
                                        </div>


                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapsefour"
                                                    aria-expanded="false" aria-controls="collapsefour">
                                                    Is it a guaranteed departure?
                                                </button>
                                            </h2>
                                            <div id="collapsefour" class="accordion-collapse collapse"
                                                data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    Lorem Ipsum has been the industry's standard dummy text ever since the
                                                    1500s, when an unknown printer took a galley of type and scrambled it to
                                                    make a type specimen book. It has survived not only five centuries, but
                                                    also the leap into electronic typesetting, remaining essentially
                                                    unchanged. </div>
                                            </div>
                                        </div>


                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapsefive"
                                                    aria-expanded="false" aria-controls="collapsefive">
                                                    Is triple occupancy available?
                                                </button>
                                            </h2>
                                            <div id="collapsefive" class="accordion-collapse collapse"
                                                data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    Lorem Ipsum has been the industry's standard dummy text ever since the
                                                    1500s, when an unknown printer took a galley of type and scrambled it to
                                                    make a type specimen book. It has survived not only five centuries, but
                                                    also the leap into electronic typesetting, remaining essentially
                                                    unchanged. </div>
                                            </div>
                                        </div>


                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapsesix"
                                                    aria-expanded="false" aria-controls="collapsesix">
                                                    Is single occupancy available ?
                                                </button>
                                            </h2>
                                            <div id="collapsesix" class="accordion-collapse collapse"
                                                data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    Lorem Ipsum has been the industry's standard dummy text ever since the
                                                    1500s, when an unknown printer took a galley of type and scrambled it to
                                                    make a type specimen book. It has survived not only five centuries, but
                                                    also the leap into electronic typesetting, remaining essentially
                                                    unchanged. </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="guests-data-section">
            <div class="container">

                <div class="guests">
                    <h2>See what guests loved the most:</h2>
                    <div class="guests-inner">
                        <div class="owl-carousel owl-theme guests-slider">
                            <div class="item">
                                <div class="guests-wapper">
                                    <div class="guests-wapper-head">
                                        <figure>
                                            <img src="{{ asset('web/assets/images/experience-one.png') }}">
                                        </figure>
                                        <h2>Yuvraj sharma</h2>
                                    </div>
                                    <p>I went for my honeymoon with Travel Agency. I discussed about my destination with
                                        akash and he shared an amazing itinerary which covered all the places of Goa which
                                        were a must visit during month of december. </p>
                                </div>
                            </div>
                            <div class="item">
                                <div class="guests-wapper">
                                    <div class="guests-wapper-head">
                                        <figure>
                                            <img src="{{ asset('web/assets/images/experience-two.png') }}">
                                        </figure>
                                        <h2>Suraj sharma</h2>
                                    </div>
                                    <p>I went for my honeymoon with Travel Agency. I discussed about my destination with
                                        akash and he shared an amazing itinerary which covered all the places of Goa which
                                        were a must visit during month of december. </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <section class="hotels-section">
            <div class="container">
                <div class="hotels-inner">
                    <h2>Featured Packages</h2>

                    <div class="hotels-bottom">
                        <div class="row">
                            <div class="col-sm-6 col-md-4">
                                <div class="hotels-wapper">
                                    <figure>
                                        <img src="{{ asset('web/assets/images/hotel-one.png') }}">
                                    </figure>
                                    <div class="hotels-content">
                                        <a href="package-single.php">
                                            <h3>Croatia Land & Sea</h3>
                                        </a>
                                        <p>Per night before taxes and fees</p>
                                        <span class="inr">$ 4,403.29</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-4">
                                <div class="hotels-wapper">
                                    <figure>
                                        <img src="{{ asset('web/assets/images/hotel-two.png') }}">
                                    </figure>
                                    <div class="hotels-content">
                                        <a href="#">
                                            <h3>Highlights of Norway</h3>
                                        </a>
                                        <p>Per night before taxes and fees</p>
                                        <span class="inr">$ 1,937.53</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-4">
                                <div class="hotels-wapper">
                                    <figure>
                                        <img src="{{ asset('web/assets/images/hotel-three.png') }}">
                                    </figure>
                                    <div class="hotels-content">
                                        <a href="#">
                                            <h3>Japan Great discovery</h3>
                                        </a>
                                        <p>Per night before taxes and fees</p>
                                        <span class="inr">$ 1,417.86</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>   
@endsection
