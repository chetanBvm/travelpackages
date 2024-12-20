var selectedCategory = '';
var selectedCity = false;
var departureCity;
$('.travel-btn.request').click(function () {
    $('.priceTab').trigger('click');
    $('html, body').animate({
        scrollTop: $(".package-details-tabs").offset().top - 100 // Adjust offset as needed
    }, 500);
});


if ($(".action_rates option:selected").text() == 'Select a city' || $(".action_rates option:selected").text() == 'SÃ©lectionnez une ville') {
    $("#month_prices").prop('disabled', true);
}

$('#month_prices').parent().click(function () {
    if ($(".action_rates option:selected").text() == 'Select a city' || $(".action_rates option:selected").text() == 'SÃ©lectionnez une ville') {
        $(".action_rates").css({ border: '1px solid red' });
    }
})

//On change to the departure city drop down, show list price
$('.action_rates').change(function () {

    var depCityId = $(this).val();
    var cur_cat = $('#cat_prices').val();

    if (depCityId !== '') {
        $(".action_rates").css({ border: '1px solid #CCC' });
        $(".month_prices").removeClass('d-none').show();
    }
    if (depCityId !== '') {
        $(".action_rates").css({ border: '1px solid #CCC' });
        $(".cat_prices").removeClass('d-none').show();
    }
    $('#modal_cat').prop('disabled', false);
    $('#modal_cat').css({ opacity: 1 });
    
    thisDepc = '';
    $.ajax({
        url: '/departure-flights/year',
        type: 'post',
        data: {
            DEPC: depCityId,
            CAT: cur_cat,
            _token: $('meta[name="csrf-token"]').attr('content'),
        },
        success: function (response) {
            if (response.success) {
                if (response.data && response.data.length > 0) {
                    departureCity = response.cityName;
                    renderFlights(response.data);
                } else {
                    showOtherModal();
                }
            } else {
                alert('No flights found for this destination.');
                showOtherModal();
            }
        }
    });
});

$('#month_prices').change(function () {
    var depCityId = $('.action_rates').val();
    let selectedMonth = $('#month_prices').val();
    var cur_cat = $('#cat_prices').val();

    if (selectedMonth == 'all') {
        fetchFlightsByCityAndMonth(depCityId, selectedMonth, cur_cat);
    } else if (depCityId && selectedMonth && cur_cat) {
        fetchFlightsByCityAndMonth(depCityId, selectedMonth, cur_cat);
    }
});

$('#cat_prices').change(function () {
    var depCityId = $('.action_rates').val();
    let selectedMonth = $('#month_prices').val();
    var cur_cat = $('#cat_prices').val();
    fetchFlightsByCityAndMonth(depCityId, selectedMonth, cur_cat);
})

function fetchFlightsByCityAndMonth(cityId, month, cur_cat) {
    $.ajax({
        url: '/departure-flights/year',
        type: 'POST',
        data: {
            DEPC: cityId,
            month: month,
            CAT: cur_cat,
            _token: $('meta[name="csrf-token"]').attr('content'),
        },
        success: function (response) {
            if (response.success) {
                renderFlights(response.data);
            } else {
                $('#flightsContainer').html('<p>No flights found for the selected city and month.</p>');
            }
        }
    });
}

function renderFlights(data) {
    let container = $('#flightsContainer');
    container.empty();


    if (data && Object.keys(data).length > 0) {

        Object.values(data).forEach(yearData => {

            container.append(`<div class="ticket-date-name">
                <h3 class="monthPriceRow">${yearData.month} ${yearData.year}</h3></div>`);

            yearData.flights.forEach(flight => {

                //convert the departure and return dates
                const departureDate = new Date(flight.departure_date);
                const returnDate = new Date(flight.return_date);

                // Format the dates to "Day Month Date"
                const formattedDepartureDate = departureDate.toLocaleDateString('en-US', {
                    weekday: 'short', // Fri
                    month: 'short', // Apr
                    day: 'numeric' // 11
                });

                const formattedReturnDate = returnDate.toLocaleDateString('en-US', {
                    weekday: 'short',
                    month: 'short',
                    day: 'numeric'
                });

                // Set the image paths dynamically or use defaults
                let airplaneImg = airplaneIcon;
                let returnImg = returnIcon;
                let priceImg = priceIcon;
                var price = parseFloat(flight.package.price) || 0;

                let flightPrice = parseFloat(flight.price) || 0;
                let totalPrice = flightPrice + price;

                let priceLabel = 'Starting Price';
                let priceClass = '';
                if (flight.status === 'Sold Out') {
                    priceLabel = 'Sold Out';
                    priceClass = 'blurred-price';
                } else if (flight.status === 'On Request') {
                    priceLabel = 'On Request';
                } else if (flight.status === 'Show Price') {
                    priceLabel = 'Price';
                }

                const flightPriceDisplay = (flight.status === 'On Request' || flight.status === 'Sold Out')
                    ? `<h4>${priceLabel}</h4>`
                    : `<h4>${totalPrice}<span>/person</span></h4>`;
                const enquiryButton = flight.status === 'Sold Out'
                    ? `<div class="status-label"> <a class="travel-btn btn" href="javascript::" >Sold Out</a></div>`
                    : `<div class="enquiry-btn">
                        <a class="travel-btn btn book_by_date" href="javascript::" data-bs-toggle="modal" data-bs-target="#exampleModal"  data-tourstartdate="${formattedDepartureDate}" data-date="${formattedDepartureDate}" data-city="${departureCity}"data-category="${flight.category}" data-price="${price}">Send Enquiry</a>
                   </div>`;
                container.append(
                    `<div class='ticket-details-bottom-main'>
                                        <div class="ticket-details-bottom-inner">
                                            <div class="ticket-detail-bottom-data">
                                                <span><img src="${airplaneImg}">Departure Date</span>
                                                <h4>${formattedDepartureDate}</h4>
                                                </div>
                                                <div class="ticket-detail-bottom-data">
                                                <span><img src="${returnImg}">Return Date</span>
                                                <h4>${formattedReturnDate}</h4>
                                            </div>
                                            <div class="ticket-detail-bottom-data ${priceClass}">
                                                <span><img src="${priceImg}">Starting Price</span>
                                                <div class="price-details-data">
                                                    ${flightPriceDisplay}
                                                </div>
                                            </div>
                                            <div class="ticket-details-right-data">
                                            <div class="offers-data">
                                                <span>100$ off</span>
                                            </div>
                                            ${enquiryButton}
                                        </div>
                    </div>
                `);
            });
        });
    } else {
        container.append('<p>No flights available.</p>');
    }
}


function showOtherModal() {
    $('#exampleModal').modal('show');
    $('#modal-form .form_fill').prop('disabled', false);
}

var insert_counter = false;
$('.getAirport').keydown(function (e) {

    var code = e.keyCode || e.which;
    if (code == 9 && $('#results_frame').html() != '') {
        $('#results_frame .q_result > p:eq(0)').click();
    }
});

$('.getAirport').keyup(function (e) {
    $("#airport_code").val('');
    var accInput = $(this);
    var q = $(accInput).val();
    if (q != '') {
        var result = getAirports(data_int_na.airports, q);
        if (result == "") {
            if (!insert_counter) {
                $('head').append("<script src=\"/web/assets/js/all_airports.js?v=456\"></script>");
                insert_counter = true;
            }
            result = getAirports(data_all.airports, q);
        }
        $('#results_frame').html(result);

    } else {
        $('#results_frame').html('');
    }
})

$('html').on('click', '.packRes p', function () {
    var code = $(this).data('code');
    var city = $(this).data('city');
    var country = $(this).data('country');

    $(".departure_city").val(city + ' (' + code + ')');
    $("#departure_city").val(city);
    $("#airport_code").val(code);

    if ($('#modal_cat').length == 0) {
        $('.departure_date').prop('disabled', false);
        $('.departure_date').css({ opacity: 1 });
    } else {
        $('#modal_cat').prop('disabled', false);
        $('#modal_cat').css({ opacity: 1 });
    }

    if ($('.departure_date').val() != '') {
        $('.departure_date').change();
    }
    $('.q_result').remove();

});

$('#exampleModal').on('show.bs.modal', function (event) {
    $(this).find('input[name="departure_city"]').val(departureCity);
    var departure = $('.action_rates').val();

    $.ajax({
        url: '/get-departure-dates',
        type: 'GET',
        data: {
            DEPC: departure
        },
        success: function (response) {
            if (response.success) {
                let dateList = response.dates;
                let html = '';

                dateList.forEach(date => {
                    html += `<option value="${date.date}" ${date.status == 'Sold Out' ? 'disabled' : ''}>${date.date} ${date.status == 'Sold Out' ? '(Sold Out)' : ''}</option>`;
                });
                $('.departure_date').html(html).prop('disabled', false);
            }
        }
    });
});

$('#modal_cat').change(function () {
    let package = $('#package_id').val();

    $.ajax({
        url: '/get-departure-dates-airport',
        type: 'GET',
        data: {
            pacakgeId: package
        },
        success: function (response) {
            let dateList = response.dates;
            let html = '';

            dateList.forEach(date => {
                html += `<option value="${date.date}" ${date.status == 'Sold Out' ? 'disabled' : ''}>${date.date} ${date.status == 'Sold Out' ? '(Sold Out)' : ''}</option>`;
            });
            $('.departure_date').html(html).prop('disabled', false);
            let defaultDate = dateList.length > 0 ? dateList[0].date : '';
            if (defaultDate) {
                $('.departure_date').val(defaultDate).trigger('change'); // Update and trigger any change event listeners
            }
        }
    });
})

$(".departure_date").change(function () {
    var defaultdate = $(this).val();
    var tour_start_date = $(this).find(":selected").data('landdate');
    $('#tour_start_date').val(tour_start_date);
    $("#departure_date").val(defaultdate);
    $('#earliest_date').val(defaultdate);
    $('#return_date').val(defaultdate);
});

function validateFields(elm) {
    valid = true;
    fields = elm.find('input, textarea, select');
    $(fields).css({ border: '1px solid #CCC' });
    for (i = 0; i < $(fields).length; i++) {

        if (($(fields).eq(i).val() == '' || $(fields).eq(i).val() == null) && $(fields).eq(i).attr('required')) {
            valid = false;
            $(fields).eq(i).css({ 'border': '1px red solid' });
            console.log("error on " + $(fields).eq(i).attr('name'));
        }

        if ($(fields).eq(i).attr('type') == 'email' && !validEmail($(fields).eq(i).val()) && $(fields).eq(i).attr('required')) {
            valid = false;
            $(fields).eq(i).css({ 'border': '1px red solid' });
            console.log("error on " + $(fields).eq(i).attr('name'));
        }

        if ($(fields).eq(i).attr('type') == 'tel' && !validTel($(fields).eq(i).val()) && $(fields).eq(i).attr('required')) {
            valid = false;
            $(fields).eq(i).css({ 'border': '1px red solid' });
            console.log("error on " + $(fields).eq(i).attr('name'));
        }
    }
    return valid;
}

function validEmail(email) {
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

function validTel(tel) {
    //Assume +1(999)-000.001 / 02 e. ext. #00-99 or any combination
    var newtel = tel.replace(/\+/g, "");  //Remove all +
    newtel = newtel.replace(/\(/g, ""); // Remove all (
    newtel = newtel.replace(/\)/g, ""); // Remove all )
    newtel = newtel.replace(/\./g, ""); // Remove all .
    newtel = newtel.replace(/\-/g, ""); // Remove all -
    newtel = newtel.replace(/\//g, ""); // Remove all /
    newtel = newtel.replace(/#/g, ""); // Remove all #
    newtel = newtel.replace(/ext/gi, ""); // Remove all ext
    newtel = newtel.replace(/e/gi, ""); // Remove all e
    newtel = newtel.replace(/ /g, ""); // Remove all spaces ' '
    if (isNaN(newtel) || newtel == '') {
        return false; //newtel must be a number
    } else {
        return true;
    }
}


$('#modal-form #submit_search').click(function () {
    var parentDiv = $("#signup").parent();
    if ($("#signup").prop('checked') == false) {
        $("#signup").css({ 'border': '1px solid red' });
        $(parentDiv).css({ "border-color": 'red' });
        var requiredCheckbox = "You must accept the terms and conditions to proceed.";
        $('#terms-error').html(requiredCheckbox).fadeIn();

    } else {
        $("#signup").css({ "border": '1px solid #121f3d' });
        $(parentDiv).css({ "border-color": '#ffffff' });
        $('#terms-error').html("").fadeIn();
    }
});

$('#modal-form').submit(function (event) {
    event.preventDefault();
    multiple_requests = window.location.href;

    //loading
    $("#fullPageLoader").fadeIn();
    var vars = $(this).serialize();

    var thisEmail = $('input[name="email"]', this);
    var thisConfirmation = $('input[name="c_email"]', this);
    var thisPhone = $('input[name="phone"]', this);

    $url = $('#modal-form').attr('action');
    $.ajax({
        method: 'POST',
        url: $url,
        timeout: 20000,
        data: vars,
        success: function (response) {
            // $("#loadBooking").fadeOut();
            // $("#sbmBooking").fadeIn();
            $("#fullPageLoader").fadeOut();
            if (response.success == true) {
                
                Swal.fire({
                    title: 'Success!',
                    text: 'Your booking has been submitted successfully!',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(() => {
                    location.reload(); // Reload the page after user confirms
                });
            }else{
                Swal.fire({
                    title: 'Error!',
                    text: response.message || 'An error occurred. Please try again later.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
           
        }, error: function (jqXHR, textStatus, errorMessage) {
            // Handle error, including timeout error
            $("#fullPageLoader").fadeOut();
            if (textStatus === 'timeout') {
                    Swal.fire({
                        title: 'Error!',
                        text: 'The server took too long to respond. Please try again.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                // $('html, body').animate({ scrollTop: 0 }, 500);
                // $('#request_form').css({ 'top': '50px' });
                // $("#loadBooking").fadeOut();
                // $('#modal-form').fadeOut();
                // var err = new Error('Booking Request Error - submission timed out:' + JSON.stringify(errorMessage) + ' Form Vars: ' + JSON.stringify(vars));
                // newrelic.noticeError(err);
                // $('#errorBooking').html('FATAL ERROR SERVER TIMEOUT. PLEASE CONTACT US').fadeIn();

            } else {
                Swal.fire({
                    title: 'Error!',
                    text: 'An error occurred: ' + errorMessage,
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                // Display other error message
                // $('html, body').animate({ scrollTop: 0 }, 500);
                // $('#request_form').css({ 'top': '50px' });
                // $("#loadBooking").fadeOut();
                // $('#modal-form').fadeOut();
                // var err = new Error('Booking Request Error - other ajax submit error: ' + JSON.stringify(errorMessage) + ' Form Vars: ' + JSON.stringify(vars));
                // newrelic.noticeError(err);
                // $('#errorBooking').html('FATAL ERROR. PLEASE CONTACT US. ' + errorMessage).fadeIn();
            }
        }

    });

});


$.fn.serializeObject = function () {
    var obj = {};
    var arr = this.serializeArray();
    $.each(arr, function () {
        if (obj[this.name]) {
            if (!Array.isArray(obj[this.name])) {
                obj[this.name] = [obj[this.name]];
            }
            obj[this.name].push(this.value || '');
        } else {
            obj[this.name] = this.value || '';
        }
    });
    return obj;
};


// Wait for the DOM to be ready
$(document).ready(function () {
    // Get DOM elements
    const $personsSelect = $('#passengers_adult');
    const $roomOptionsDiv = $('#room_occupancy');

    // Room types and their configurations
    const ROOM_TYPES = {
        SINGLE: 'Single Room',
        DOUBLE: 'Double Room',
        TRIPLE: 'Triple Room',
        QUADRUPLE: 'Quadruple Room',
    };

    // Calculate room combinations based on number of persons
    function calculateRoomOptions(numberOfPersons) {
        let roomCombinations = [];

        switch (numberOfPersons) {
            case 1:
                roomCombinations.push({
                    description: '1 Single Room',
                    rooms: [{ type: ROOM_TYPES.SINGLE, count: 1 }]
                });
                break;

            case 2:
                roomCombinations.push({
                    description: '2 Single Rooms',
                    rooms: [{ type: ROOM_TYPES.SINGLE, count: 2 }]
                });
                roomCombinations.push({
                    description: '1 Double Room',
                    rooms: [{ type: ROOM_TYPES.DOUBLE, count: 1 }]
                });
                break;

            case 3:
                roomCombinations.push({
                    description: '3 Single Rooms',
                    rooms: [{ type: ROOM_TYPES.SINGLE, count: 3 }]
                });
                roomCombinations.push({
                    description: '1 Double Room + 1 Single Room',
                    rooms: [
                        { type: ROOM_TYPES.DOUBLE, count: 1 },
                        { type: ROOM_TYPES.SINGLE, count: 1 }
                    ]
                });
                break;

            case 4:
                roomCombinations.push({
                    description: '4 Single Rooms',
                    rooms: [{ type: ROOM_TYPES.SINGLE, count: 4 }]
                });
                roomCombinations.push({
                    description: '2 Double Rooms',
                    rooms: [{ type: ROOM_TYPES.DOUBLE, count: 2 }]
                });
                roomCombinations.push({
                    description: '1 Double Room + 2 Single Rooms',
                    rooms: [
                        { type: ROOM_TYPES.DOUBLE, count: 1 },
                        { type: ROOM_TYPES.SINGLE, count: 2 }
                    ]
                });
                break;

            case 5:
                roomCombinations.push({
                    description: '5 Single Rooms',
                    rooms: [{ type: ROOM_TYPES.SINGLE, count: 5 }]
                });
                roomCombinations.push({
                    description: '2 Double Rooms + 1 Single Room',
                    rooms: [
                        { type: ROOM_TYPES.DOUBLE, count: 2 },
                        { type: ROOM_TYPES.SINGLE, count: 1 }
                    ]
                });
                roomCombinations.push({
                    description: '1 Double Room + 3 Single Rooms',
                    rooms: [
                        { type: ROOM_TYPES.DOUBLE, count: 1 },
                        { type: ROOM_TYPES.SINGLE, count: 3 }
                    ]
                });
                break;

            default:
                roomCombinations.push({
                    description: 'Please select number of persons',
                    rooms: []
                });
        }

        return roomCombinations;
    }

    // Display room options in the UI

    function displayRoomOptions(options) {

        $roomOptionsDiv.empty(); // Clear the existing options

        const $dropdown = $('#room_occupancy');
        $dropdown.empty();

        // Add a default option that is always visible
        $dropdown.append($('<option>', {
            value: '',
            text: 'Select a room option',
            disabled: true,
            selected: true
        }));

        // Add options to the dropdown
        options.forEach((option, index) => {
            const $option = $('<option>', {
                value: index,
                text: option.description
            });

            $dropdown.append($option);
        });

        // Append the dropdown to the room options div
        $roomOptionsDiv.append($dropdown);

        // Bind a change event to handle user selection
        $dropdown.on('change', function () {
            const selectedIndex = $(this).val(); // Get the selected value
            if (selectedIndex === '') {
                console.log('Default option selected.');
            } else {
                const selectedOption = options[selectedIndex];
                console.log('Selected Room Option:', selectedOption);
                // Additional logic for when a room option is selected
            }
        });

        // Reset dropdown to default option when needed
        $dropdown.val(''); // Ensure the default option is shown initially
    }



    // Event listener for person selection change
    $personsSelect.on('change', function () {
        const numberOfPersons = parseInt($(this).val());
        const roomOptions = calculateRoomOptions(numberOfPersons);
        displayRoomOptions(roomOptions);
    });
});


//Filter
$(document).ready(function () {
    $('.filter').on('change', function () {
        const sortValue = $("#sort-days").val(); // Get selected value
        const priceValue = $('#price-filter').val();
        
        $.ajax({
            url: '/packages/sort',
            type: 'GET',
            data: { sort: sortValue ,price: priceValue},
            success: function (response) {
                // Update the package list with the response data
                $('#package-list').html(response);
            },
            error: function () {
                alert('Error fetching sorted packages.');
            }
        });
    });
});
