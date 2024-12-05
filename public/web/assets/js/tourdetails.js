// departure date 
$(".departure_date").change(function () {
    var defaultdate = $(this).val();
    $("#departure_date").val(defaultdate);
});

function validateFields(elm) {
    valid = true;
    fields = elm.find('input, textarea, select');
    $(fields).css({border: '1px solid #CCC'});
    for (i = 0; i < $(fields).length; i++) {

        if (($(fields).eq(i).val() == '' || $(fields).eq(i).val() == null) && $(fields).eq(i).attr('required')) {
            valid = false;
            $(fields).eq(i).css({'border': '1px red solid'});
            console.log("error on " + $(fields).eq(i).attr('name'));
        }

        if ($(fields).eq(i).attr('type') == 'email' && !validEmail($(fields).eq(i).val()) && $(fields).eq(i).attr('required')) {
            valid = false;
            $(fields).eq(i).css({'border': '1px red solid'});
            console.log("error on " + $(fields).eq(i).attr('name'));
        }

        if ($(fields).eq(i).attr('type') == 'tel' && !validTel($(fields).eq(i).val()) && $(fields).eq(i).attr('required')) {
            valid = false;
            $(fields).eq(i).css({'border': '1px red solid'});
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
        $("#signup").css({'border': '1px solid red'});
        $(parentDiv).css({"border-color": 'red'});
        var requiredCheckbox = "You must accept the terms and conditions to proceed.";
        $('#terms-error').html(requiredCheckbox).fadeIn();

    } else {
        $("#signup").css({"border": '1px solid #121f3d'});
        $(parentDiv).css({"border-color": '#ffffff'});
        $('#terms-error').html("").fadeIn();
    }
});

$('#modal-form').submit(function (event) {
    event.preventDefault(); 
    multiple_requests = window.location.href;
    
        //loading
        $("#sbmBooking").fadeOut();
        $("#loadBooking").fadeIn();
        var vars = $(this).serialize();
        console.log(vars);
        
        var thisEmail = $('input[name="email"]', this);
        var thisConfirmation = $('input[name="c_email"]', this);
        var thisPhone = $('input[name="phone"]', this);
    
    $url = "/booking/store";
    alert($url);
        $.ajax({
            method: 'POST',
            url: "/booking/store",
            timeout:20000,
            data: vars,
            success: function (response) {
                // console.log(response);
                if(response.success = true){
                   
                    // $('#modal-form').fadeOut();
                    window.location.href;
                }
                // response_a = response.split(":");

                // switch (response_a[0]) {
                //     case 'EE':
                //         $(thisEmail).css({'border': '1px solid red'});
                //         alert(response_a[1]);
                //         $("#loadBooking").fadeOut();
                //         $("#sbmBooking").fadeIn();
                //         //$('#sentMsg p').html(response_a[1]);
                //         //$('#sentMsg').fadeIn();
                //         break;
                //     case 'EM':
                //         $(thisEmail).css({'border': '1px solid red'});
                //         $(thisConfirmation).css({'border': '1px solid red'});
                //         alert(response_a[1]);
                //         $("#loadBooking").fadeOut();
                //         $("#sbmBooking").fadeIn();
                //         //$('#sentMsg p').html(response_a[1]);
                //         //$('#sentMsg').fadeIn();
                //         break;
                //     case 'URL':
                //     case 'SPAM':
                //     case 'HE':
                //         //$('#sentMsg p').html(response_a[1]);
                //         //$('#sentMsg').fadeIn();
                //         alert(response_a[1]);
                //         $("#loadBooking").fadeOut();
                //         $("#sbmBooking").fadeIn();
                //         break;
                //     case 'SENT':
                //         //$('#modal').hide();
                //         //$(thisSendBtn).hide();
                //         //$('#sentMsg p').html(response_a[1]);
                //         //$('#sentMsg').fadeIn();
                //         //alert(response_a[1]);
                //         $('html, body').animate({scrollTop: 0}, 500);
                //         $('#request_form').css({'top': '50px'});
                //         $("#loadBooking").fadeOut();
                //         $('#modal-form').fadeOut();
                //         $('#errorBooking').html(response_a[2]).fadeIn();
                //         //Event snippet for Lead AW conversion page
                //         gtag('event', 'conversion', {
                //             'send_to': 'AW-366705215/WlA_CLDzoa4DEL_07a4B',
                //             'value': 0,
                //             'transaction_id': response_a[1],
                //             'currency': 'CAD'
                //         });
                //         gtag('set', 'user_data', {
                //             "email": thisConfirmation.val(),
                //             "phone_number": thisPhone.val()
                //         });

                //         if (subdomain !== 'www') {
                //             var pushHistory = subdomain + "/request_sent" + thisPage;
                //             ga('send', 'pageview', pushHistory);
                //         }
                //         // Submit Rakuten leads
                //         let clientId = response_a[1];
                //         let orderId = Date.now() + '-' + clientId;
                //         let tourPrice = parseInt($('#tour_price').val());
                //         let orderCurrency = $('#c_currency').val();
                //         let productName = $('#package_name').val();
                //         let salesQuantity = parseInt($('#passengers_adult').val()) + parseInt($('#passengers_children').val());
                //         let packageCountry = orderCurrency === 'CAD' ? 'C' : 'U';
                //         let requestLang = $('#c_lang').val();
                //         switch($('#packege_category_id').val()){
                //             case 2:
                //                 packageCategory = 'C';
                //                 break;
                //             case 3:
                //                 packageCategory = 'R';
                //                 break;
                //             default:
                //                 packageCategory = 'T';
                //         }
                //         let sku = 'WB-' + packageCategory + '-' + requestLang.toUpperCase() + $('#tour_no').val() + '-' + packageCountry;

                //         let rm_trans = {
                //             affiliateConfig: {ranMID: "53123", discountType: "item", includeStatus: "false", taxRate: 5, removeTaxFromDiscount: true, tagType: "mop"},
                //             orderid : orderId,
                //             currency: orderCurrency,
                //             conversionType: "Sale",
                //             customerID: clientId,
                //             lineitems : [{
                //                 quantity : salesQuantity,
                //                 unitPrice : tourPrice,
                //                 SKU: sku,
                //                 productName: productName,
                //             }]
                //         };
                       
                //     default:
                //         $('html, body').animate({scrollTop: 0}, 500);
                //         $('#request_form').css({'top': '50px'});
                //         $("#loadBooking").fadeOut();
                //         $('#modal-form').fadeOut();
                //         $('#errorBooking').html('FATAL ERROR. PLEASE CONTACT US').fadeIn();
                //         break;
                // }
            }, error: function(jqXHR, textStatus, errorMessage){
                // Handle error, including timeout error
                if(textStatus === 'timeout') {
                    $('html, body').animate({scrollTop: 0}, 500);
                    $('#request_form').css({'top': '50px'});
                    $("#loadBooking").fadeOut();
                    $('#modal-form').fadeOut();
                    var err = new Error('Booking Request Error - submission timed out:'+JSON.stringify(errorMessage)+' Form Vars: '+JSON.stringify(vars));
                    newrelic.noticeError(err);
                    $('#errorBooking').html('FATAL ERROR SERVER TIMEOUT. PLEASE CONTACT US').fadeIn();

                } else {
                    // Display other error message
                    $('html, body').animate({scrollTop: 0}, 500);
                    $('#request_form').css({'top': '50px'});
                    $("#loadBooking").fadeOut();
                    $('#modal-form').fadeOut();
                    var err = new Error('Booking Request Error - other ajax submit error: '+JSON.stringify(errorMessage)+' Form Vars: '+JSON.stringify(vars));
                    newrelic.noticeError(err);
                    $('#errorBooking').html('FATAL ERROR. PLEASE CONTACT US. ' + errorMessage).fadeIn();
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


var rooms = [
    { roomType: "Single", capacity: 1 },
    { roomType: "Double", capacity: 2 },
    { roomType: "Triple", capacity: 3 },
    { roomType: "Family", capacity: 4 }
];

$('#passengers_adult, #passengers_children, #modal_cat').change(function () {
    $('#room_occupancy').html('');

    var n_adults = parseInt($('#passengers_adult').val()) || 0;  // Default to 0 if undefined or NaN
    var n_children = parseInt($('#passengers_children').val()) || 0;  // Default to 0 if undefined or NaN

    let num_guests = n_adults + n_children;

    if (num_guests === 0) {
        $("#room_occupancy").append('<option value="">Select Room</option>');
    } else {
        var rooms_needed = getRooms(num_guests);

        rooms_needed.forEach(function (room) {
            $('#room_occupancy').append(`<option value="${room.count} ${room.roomType}"> ${room.count} ${room.roomType} (${room.count * room.capacity} total capacity)</option>`);
        });
    }
});

function getRooms(num_guests) {
    var rooms_needed = [];
    
    // Loop through rooms array in reverse order (start with largest room type)
    rooms.reverse().forEach(function (room) {
        while (num_guests >= room.capacity) {
            rooms_needed.push(room);
            num_guests -= room.capacity;
        }
    });

    // If there are leftover guests, add a single room
    if (num_guests > 0) {
        rooms_needed.push(rooms.find[r= r.capacity === 1]); // Adding a 'Single' room for remaining guests
    }

    // Now calculate the room combinations and format the output
    var room_summary = formatRoomSummary(rooms_needed);

    return room_summary;
}

function formatRoomSummary(rooms_needed) {
    // Create an object to count how many of each room type
    var room_count = {};
    
    rooms_needed.forEach(function (room) {
        if (!room_count[room.roomType]) {
            room_count[room.roomType] = 0;
        }
        room_count[room.roomType]++;
    });

    // Build the display summary of rooms
    var room_summary = [];
    for (var roomType in room_count) {
        var count = room_count[roomType];
        var room = rooms.find(r => r.roomType === roomType); // Get room details by type
        room_summary.push({ roomType: roomType, count: count, capacity: room.capacity });
    }

    return room_summary;
}
