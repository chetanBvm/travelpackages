<div class="modal" id="exampleModal" data-tour="803" style="">
    <div class="modal_overlay"></div>
    <div class="modal-dialog modal-lg" id="request_form">
        <div class="modal-content" id="modal-content">
            <div id="request_form" class="modal-body">
                <h2 class="blue_bg white_font uppercase bold">Request a booking </h2>
                <div class="close_box2"><i class="fa fa-times"></i></div>
                <div class="padding30" id="errorBooking">Error</div>
                <form id="modal-form" name="modal-form" class="searchPackage" method="POST" onsubmit="return false">
                    <input type="hidden" id="pageName" value="/tour_trip/803/costa-rica-escape-toronto?stab=true">
                    <input type="hidden" name="tour_no" id="tour_no"
                           value="803">
                    <input type="hidden" id="package_category_id" value="1">
                    <input type="hidden" id="package_name" value="Costa Rica Escape">
                    <input type="hidden" name="c_formName" value="booking">
                    <input type="hidden" name="c_list" id="c_list" value="IN">
                    <input type="hidden" name="c_lang" id="c_lang" value="en">
                    <input type="hidden" name="c_currency" id="c_currency"
                           value="CAD">
                    <input type="hidden" name="request_type" id="request_type" value="Available">
                    <input type="hidden" name="airport_code" id="airport_code">
                    <input type="hidden" name="departure_date" id="departure_date">
                    <input type="hidden" name="departure_city" id="departure_city">
                    <input type="hidden" name="tour_start_date" id="tour_start_date">
                    <input type="hidden" name="tour_price" id="tour_price" value="0.00">
                    <input type="hidden" name="single_sup_price" id="single_sup_price" value="0">
                    <input type="hidden" name="room_description" id="room_description"
                           value="1 room(s) in double occupancy ">
                    <input type="hidden" name="room_config" id="room_config" required value="1,0,0,0">
                    <!-- double, triple, single -->
                    <input type="hidden" name="cat_size" id="cat_size"
                           value="2">
                    <input type="hidden" name="hotel_category" id="hotel_category"
                           value="Classic Hotels">
                    <input type="hidden" name="hotel_id" id="hotel_id"
                           value="1">
                    <input type="hidden" name="q_currency" id="q_currency" value="CAD">
                    <input type="hidden" id="triple_must_have_children"
                           value="0">
                    <input type="hidden" id="quad_must_have_children"
                           value="1">

                    <div class="col-12 col-mob-12 clearFix main_modal">
                        <p class="blueTxt uppercase s22 col-mob-12" style="text-align:center">
                            <strong>Costa Rica Escape</strong>
                        </p>
                    </div>
                    <div class="clearFix">
                                                <div class="col-4 col-mob-12 floatLeft ">
                            <p class="blueTxt uppercase s18"><span
                                        class="bold"></span>Departure City                            </p>
                            <div class="select_wrap relative">
                                <input type="text" value="" class="form_fill getAirport departure_city"
                                       placeholder="Departure Airport"
                                       autocomplete="new-text">
                                <div id="results_frame"></div>
                            </div>
                        </div>
                                                    <div class="col-4 col-mob-12  clearFix floatLeft">
                                <p class="blueTxt uppercase s18"><span
                                            class="bold"></span>Accommodation                                </p>

                                <div class="select_wrap">
                                    <select required class="uppercase form_fill" id="modal_cat"
                                            style="font-size: 14px;">
                                        <option selected
                                                value="">select an option</option>
                                                                                    <option value="1">Classic Hotels</option>
                                                                                    <option value="2">Superior Hotels</option>
                                                                            </select>
                                </div>

                            </div>
                                                <div class="col-4 col-mob-12 floatLeft ">
                            <p class="blueTxt uppercase s18"><span
                                        class="bold"></span>DATE                            </p>
                            <div class="select_wrap" id="date_selector">
                                <select disabled class="uppercase form_fill flex_select departure_date " required>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-mob-12 clearFix">

                        
                        <p class="blueTxt uppercase s18"><span
                                    class="bold"></span>How many passengers are you?                        </p>
                        <div class="col-3 col-mob-12 floatLeft">
                            <div class="select_wrap">
                                <select class="uppercase form_fill" name="passengers_adult" id="passengers_adult">
                                    <option value="1">
                                        1 adult</option>
                                    <option selected value="2">
                                        2 adults</option>
                                    <option value="3">
                                        3 adults</option>
                                    <option value="4">
                                        4 adults</option>
                                    <option value="5">
                                        5 adults</option>
                                    <option value="6">
                                        6 adults</option>
                                    <option value="7">
                                        7 adults</option>
                                    <option value="8">
                                        8 adults</option>
                                    <option value="9">
                                        9 adults</option>
                                    <option value="10">
                                        10+ (Group request)</option>
                                    <!--option value="11">11+ (Group request)</option-->
                                </select>
                            </div>
                        </div>
                                                    <div class="col-3 col-mob-12 floatLeft">
                                <div class="select_wrap">
                                    <select class="uppercase form_fill" name="passengers_children"
                                            id="passengers_children">
                                        <option value="0"
                                                selected>0 child (2-11)</option>
                                        <option value="1">1 child (2-11)</option>
                                        <option value="2">2 children (2-11)</option>
                                        <option value="3">3 children (2-11)</option>
                                        <option value="4">4 children (2-11)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-3 col-mob-12 floatLeft">
                                <div class="select_wrap">
                                    <select class="uppercase form_fill" name="passengers_infant" id="passengers_infant">
                                        <option value="0"
                                                selected>0 infant (&lt;2)</option>
                                        <option value="1">1 infant (&lt;2)</option>
                                        <option value="2">2 infants (&lt;2)</option>
                                        <option value="3">3 infants (&lt;2)</option>
                                        <option value="4">4 infants (&lt;2)</option>
                                    </select>
                                </div>
                            </div>
                        
                        <div class="col-3 col-mob-12 floatLeft">
                            <div class="select_wrap">
                                <select class="uppercase form_fill" name="room_occupancy" id="room_occupancy">
                                    <option data-index="0" value="1"
                                            selected>1 room(s) (1 Double)</option>
                                </select>
                            </div>

                        </div>
                    </div>

                    <div class="col-12 col-mob-12 none" id="roomError">
                        <p class="uppercase s18 aCenter"><span
                                    class="bold"></span>Please modify your room selection as it is not a valid option.                        </p>
                    </div>
                    <div class="col-12 col-mob-12 none" id="childrenError">
                        <p class="uppercase s18 aCenter"><span
                                    class="bold"></span>Triple/Quadruple occupancy must have a child in a room                        </p>
                    </div>

                    <div class="col-12 col-mob-12 none" id="groupWarning">
                        <p class="uppercase s18 aCenter">
                            A detailed group quote will be sent to you shortly!                        </p>
                        <div class="blueTxt uppercase s18">
                            <span>
                              SPECIAL REQUESTS / QUESTIONS?                            </span>
                        </div>
                        <div class="select_wrap">
                            <textarea style="width: 100%; height:100px; padding:9px 10px" cols="60" rows="3" id="special_requests" name="special_requests" class="bbox fill_textarea form_fill" placeholder="(optional)"></textarea>
                        </div>
                    </div>

                    <div class="main_modal">
                        <div class="col-12 col-mob-12 clearFix priceSummaryRequest">
                            <p class="blueTxt uppercase s18"
                               style="padding:10px 0"> PRICE PER PERSON, TAXES INCLUDED</p>
                            <div class="col-12 col-mob-12">
                                <div class="col-4 col-mob-12 floatLeft bbox selected_price">
                                                                            <div class="curr blueTxt">*CAD$</div>
                                                                        <div id="selected_price" class="extrabold blueTxt"></div>
                                                                    </div>
                                <div class="col-8 col-mob-12 floatLeft bbox category"
                                     style="position: relative; font-size: 16px;">

                                    <div>
                                        <span id="doubleMsg"><b>1</b>  room(s) in double occupancy <br></span>
                                        <span id="tripleMsg"
                                              class="none"><b></b>  room(s) in triple occupancy <br></span>
                                        <div class="triple_price  blueTxt bold">+
                                            <span>$</span><span
                                                    id="triple_price"></span>                                              / TRIPLE OCCUPANCY SUPPLEMENT                                         </div>

                                        <span id="quadMsg"
                                              class="none"><b></b>  room(s) in quad occupancy <br></span>
                                        <div class="quad_price  blueTxt bold none">+
                                            <span>$</span><span
                                                    id="quad_price"></span>                                              / QUAD OCCUPANCY SUPPLEMENT                                         </div>
                                        <span id="singleMsg"
                                              class="none"><b></b>  room(s) in single occupancy </span>
                                        <div class="singl_price  blueTxt bold">+
                                            <span>$</span><span
                                                    id="singl_price"></span>                                              / SINGLE OCCUPANCY SUPPLEMENT                                         </div>
                                        <div class="childDiscount blueTxt bold none">
                                             + 15% Discount per child                                         </div>
                                        <div class="infantPrice blueTxt bold none">
                                             + $150 per infant                                         </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-mob-12">
                        <p class="blueTxt uppercase s18">Your contact information</p>

                        <div id="adult_1" class="show_adult" data-num="1">
                            <div class="col-6 col-mob-12 floatLeft">
                                <div class="select_wrap ">
                                    <input type="text" value="" class="form_fill" name="adult_first_name_1"
                                           placeholder="FIRST NAME*"
                                           required>
                                </div>
                            </div>
                            <div class="col-6 col-mob-12 floatLeft">
                                <div class="select_wrap ">
                                    <input type="text" value="" class="form_fill" name="adult_last_name_1"
                                           placeholder="LAST NAME*"
                                           required>
                                </div>
                            </div>
                            <div class="clearFloat"></div>
                        </div>


                        <div class="col-6 col-mob-12 floatLeft">
                            <div class="select_wrap">
                                <input type="email" class="form_fill" id="email" name="c_email"
                                       placeholder="EMAIL*"
                                       required/>
                                <div class="form-group hidden" id="email_alert">
                                    <label class="col-sm-6 control-label"></label>
                                    <div class="col-sm-5 alert alert-danger">
                                        The email is not correct.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-6 col-mob-12 floatLeft">
                            <div class="select_wrap">
                                <input type="text" class="form_fill" id="phone" name="phone"
                                       placeholder="TELEPHONE (OPTIONAL)"/>
                            </div>
                        </div>
                        <div class="clearFloat"></div>
                    </div>

                    
                    <p class="blueTxt s16 paddingT10 paddingAside30 aCenter font-600">
                        You will receive a detailed quote, to which you will be able to reply with any questions or requests you may have. An agent will be assigned to you.                     </p>


                    
                    <div class="clearFloat"></div>
                    <br>

                    
                                            <input type="hidden" name="AGID" value="1"/>
                    
                    <div class="paddingR10">
                        <div class="orangetxt aCenter" id="terms-error"
                             style="font-size:14px; padding-bottom:5px"></div>
                        <div class="padding10 bbox" style="border:1px solid #fff">
                            <input id="signup" type="checkbox" checked required class="form_fill pointer" name="signup"
                                   value="1" style="vertical-align:middle">
                            <label class="blueTxt" for="signup"
                                   style="font-size:12px">
                                I agree to be contacted by email with a follow-up to my request and receive other great deals.                            </label>
                        </div>
                    </div>
                    <div class="clearFloat"></div>
                    <div id="sbmBooking">
                        <input type="submit" id="submit_search"
                               value="Submit Request"
                               class="uppercase orange_bg submit_request_form"/>
                    </div>
                    <div id="loadBooking">
                        <i class="fa fa-spinner fa-pulse"></i>
                    </div>
                </form>

            </div>
        </div>
    </div>

</div>
