/*** Global Parameters ***/
var doubleOccPrice = '0';
var singleOccPrice = 'NA';
var tripleOccPrice = 'NA';
var quadOccPrice = 'NA';
var occ_config = "0,0,0,0"; //double, triple, single, quadruple
var selectedCategory = '';
var selectedCity = false;
var category;
var requestOnly = false;
var selectedDepartureDate;
var request_lang;
//array of avaliable occupancies
var avaliableOccupancies = {'Double': 2};
//array of occupany combinations
let arrayOfOccOptions = {0: {'Double': 1}};

var occ_summary = "";
$(document).ready(function () {
    //request language
    request_lang = $('input[name="c_lang"]').val();

    $('.toggle-review').click(function () {
        var parentItem = $(this).parent().parent();
        var showTxt = $(this).data("show");
        var hideTxt = $(this).data("hide");

        if ($(parentItem).hasClass('show')) {
            $(".btn-style", this).html(showTxt);
            $(".etc", this).fadeIn().css({display: 'inline'});
            $(parentItem).css({height: '131px'});
            $(".review-hide", parentItem).fadeOut();
            $(parentItem).removeClass('show')
        } else {
            $(".btn-style", this).html(hideTxt);
            $(".etc", this).fadeOut();
            $(parentItem).css({height: 'auto'});
            $(".review-hide", parentItem).fadeIn().css({display: 'inline'});
            $(parentItem).addClass('show')
        }
    });

    $('#modal_cat').change(function () {
        $('#hotel_id').val($(this).val());
        let category = $(this).find(":selected").text();
        $('#hotel_category').val(category.replace('&nbsp;(supplement)', ''));
        let selectedDepartureCity = $('.action_rates').find(":selected").data('air');
        let requestLang = $('#c_lang').val();

        // get list of departure dates for selected category
        let defaultFilter = priceCurrency == 'USD' ? 'DFU' : 'DFC';

        $.ajax({
            url: '/ajax/site_functions.php',
            type: 'POST',
            data: {
                action: 'getDepartureDates',
                DEPC: selectedDepartureCity,
                TOMSID: tomsid,
                DEF_FILTER: defaultFilter,
                requestLang: requestLang,
                OCCCATID: $(this).val()
            },
            success: function (response) {
                $('.departure_date').html(response);
                $('.departure_date').prop('disabled', false);
                $('.departure_date').css({opacity: 1});
                $('.priceSummaryRequest').slideUp();
                if ($('.departure_date option[value="' + selectedDepartureDate + '"]').data('onrequest') == 3) {
                    $('.departure_date').val('');
                } else {
                    $('.departure_date').val(selectedDepartureDate);
                }
                $('.departure_date').change();
            }
        });
     });

    $('.cat_link').click(function (e) {
        e.preventDefault();
        $('.catTab').click()
    });

    //"See Dates and Prices" buttons in Accommodations (data category selected), Itinerary and Inclusions/Exclusions (no data category)
    $('.select_cat').click(function () {
        selectedCategory = $(this).data('cat');
        if (selectedCategory != '') {
            $('#cat_prices').val(selectedCategory);
        }
        $('.priceTab').click();
        hideRow();
    });

    $('#cat_prices').change(function () {
        hideRow();
    });


    //COMMENTS CHANGE
    if ($(".action_rates option:selected").text() == 'Select a city' || $(".action_rates option:selected").text() == 'SÃ©lectionnez une ville') {
        $("#month_prices").prop('disabled', true);
    }

    $('#month_prices').parent().click(function () {
        if ($(".action_rates option:selected").text() == 'Select a city' || $(".action_rates option:selected").text() == 'SÃ©lectionnez une ville') {
            $(".action_rates").css({border: '1px solid red'});
        }
    })

    var multiple_requests = "";
    $('.openUpgrade').click(function () {
        $(this).parent().parent().next('div').slideToggle();
    });

    $('.openFaq').click(function () {
        $(this).parent().next('div').slideToggle();
    });


    $('.see_other_modal').click(function () {
        selectedCity = false;
        showOtherModal();
        thisDepc = '';
        $(".action_rates").val('other').change();
    });


    //On change to the departure city drop down, show list price
    $(".action_rates").change(function () {

        let depCityId = $(this).val();

        $('#modal-form .form_fill').not('.departure_city,.departure_date').prop('disabled', false);
        $('#modal-form .form_fill').not('.departure_city,.departure_date,input[type="hidden"]').css({opacity: 1});

        if (selectedCategory != '') {
            $('.priceTab').click();
            // Select the previosly selected category option from the accommodation category select
            $('#cat_prices').val(selectedCategory);
            //Show the accommodation category select
            $('#cat_prices').show();
        }

        $('.date_table_wrap').hide();

        if (depCityId !== '') {
            $(".action_rates").css({border: '1px solid #CCC'});
            $("#month_prices").prop('disabled', false);
        }

        if (depCityId === '' || depCityId == 'other') {
            $('#modal_cat').val('');
            selectedCity = false;
            showOtherModal();
            thisDepc = '';
            $('#airport_code').val('');
            $('#departure_city').val('');
            $('.departure_city').attr('disabled', false);
            $('.departure_date').attr('disabled', true);

            let requestLang = $('#c_lang').val();
            let defaultFilter = priceCurrency == 'USD' ? 'DFU' : 'DFC';

            $.ajax({
                url: '/ajax/site_functions.php',
                type: 'POST',
                data: {
                    action: 'getDepartureDates',
                    DEPC: 'DEFAULT',
                    TOMSID: tomsid,
                    DEF_FILTER: defaultFilter,
                    requestLang: requestLang,
                    OCCCATID: $("#modal_cat").val()
                },
                success: function (response) {
                    $('.departure_date').html(response);
                }
            });

        } else if (thisDepc != depCityId) {

            selectedCity = true;
            showLoading();
            $('.action_rates').not(this).val($(this).val());

            var city = $("option:selected", this).text();
            var stab = '';
            if ($(this).data('showtab') == true) {
                stab = '&stab=true';
            }

            var url_city = city.toLowerCase();
            url_city = url_city.trim();
            url_city = url_city.replace(/\s+/g, '-');
            url_city = url_city.normalize("NFD");

            new_url = static_url + '-' + url_city + '?depc=' + depCityId + stab;
            var tour_no = $('#modal').data('tour');
            $.ajax({
                url: '/ajax/site_functions.php',
                type: 'POST',
                data: {
                    action: 'find_prices',
                    depc: depCityId,
                    curr: priceCurrency,
                    pack: tomsid,
                    tour_no:tour_no,
                    month: $('#month_prices').val(),
                    sub: subdomain,
                    dev: dev
                },
                success: function (response) {
                    $('.date_table_wrap').html('');
                    // If no results we pop the modal form to ask for information
                    if(response === '') {
                        $('#modal_cat').val('');
                        selectedCity = false;
                        showOtherModal();
                        thisDepc = '';
                        $('#airport_code').val('');
                        $('#departure_city').val('');
                        $('.departure_city').attr('disabled', false);
                        $('.departure_date').attr('disabled', true);

                        let requestLang = $('#c_lang').val();
                        let defaultFilter = priceCurrency == 'USD' ? 'DFU' : 'DFC';

                        $.ajax({
                            url: '/ajax/site_functions.php',
                            type: 'POST',
                            data: {
                                action: 'getDepartureDates',
                                DEPC: 'DEFAULT',
                                TOMSID: tomsid,
                                DEF_FILTER: defaultFilter,
                                requestLang: requestLang,
                                OCCCATID: $("#modal_cat").val()
                            },
                            success: function (response) {
                                $('.departure_date').html(response);
                            }
                        });
                    } else {
                        $('.date_table_wrap').html(response);
                        thisDepc = depCityId;
                        hideRow();
                        if (catCount > 1) {
                            $('.cat_ddown').show();
                        }
                        $('.date_ddown').show();
                        history.replaceState({id: 'tourdetail'}, title, new_url);
                        $('.date_table_wrap').slideDown();
                        hideLoading();
                    }
                }
            });

        } else {
            //Same Departure City, No changes
            if (catCount > 1) {
                $('.cat_ddown').slideDown();
            }
            $('.date_ddown').slideDown();
            hideRow();
            $('.date_table_wrap').show();
        }
    });

    /***** On change only in Other Modal *****/
    $('.departure_date').change(function () {
        //requestOnly = true;
        //Get Base Price
        //$departureDateId
        selectedDepartureDate = $(this).val();
        if(!selectedDepartureDate){
            return;
        }
        onRequestStatus($(this).find(":selected").data('onrequest'));
        $.ajax({
            url: '/ajax/site_functions.php',
            type: 'POST',
            data: {
                action: 'other_departure_city',
                curr: priceCurrency,
                pack: tomsid,
                OCCCATID: $('#hotel_id').val(),
                city: $("#airport_code").val(),
                date: $('.departure_date option:selected').data("landdate")
            },
            success: function (response) {
                response = JSON.parse(response);

                    $('#tour_price').val(response.PRICE);
                    $('#selected_price').html(parseInt(response.PRICE).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));

                //Get Price Single na other supplements
                $.ajax({
                    url: '/ajax/site_functions.php',
                    type: 'POST',
                    data: {
                        action: 'getSingl',
                        did: response.PDEPID,
                        curr: $('#q_currency').val(),
                        cid: $('#hotel_id').val()
                    },
                    success: function (r) {
                        r = JSON.parse(r);
                        if (r.Single != 'not found') {
                            singleOccPrice = r.Single;
                            $('#singl_price').html(parseInt(singleOccPrice).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));

                            // if single is avaliable create <opltion> for ddown and add values to array of avaliable occupancies
                            var single_name = request_lang === 'en' ? 'Single' : 'Simple';
                            avaliableOccupancies[single_name] = 1;
                            arrayOfOccOptions[1] = {'Single': 2};

                        } else {
                            singleOccPrice = 'NA';
                            $('#singl_price').html("");
                        }
                        if (r.Triple != 'not found') {
                            tripleOccPrice = r.Triple;
                            $('#triple_price').html(parseInt(tripleOccPrice).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                            avaliableOccupancies['Triple'] = 3;
                        } else {
                            tripleOccPrice = 'NA';
                            $('#triple_price').html("");
                        }

                        if (r.Quad != 'not found') {
                            quadOccPrice = r.Quad;
                            $('#quad_price').html(parseInt(quadOccPrice).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                            avaliableOccupancies['Quadruple'] = 4;

                        } else {
                            quadOccPrice = 'NA';
                            $('#quad_price').html("");
                        }
                        $('#room_occupancy').change();
                    }
                });
            }
        });
        $('#modal-form .form_fill').not('.departure_city,.departure_date,input[type="hidden"]').css({opacity: 1});
        $('#modal-form .form_fill').not('.departure_city,.departure_date').prop('disabled', false);
        $('#modal-form input[type="submit"]').prop('disabled', false);
    });

    $('#passengers_adult,#passengers_children,#modal_cat').change(function () {
        arrayOfOccOptions = [];
        //Clean values from rooms dropdown
        $('#room_occupancy').html('');

        //array of avaliable occupancies for package
        let rooms = avaliableOccupancies;

        var n_adults = parseInt($('#passengers_adult').val());
        var n_children = parseInt($('#passengers_children').val());


        let num_guests = n_adults + n_children;

        //Generate array of possible occupancy combinations
        generateCombinations(num_guests, rooms);
        
        //sort each element(array of key value pairs) in array by key
        arrayOfOccOptions = sortInternalArrays(arrayOfOccOptions);

        //Remove duplicates from array
        arrayOfOccOptions = Array.from(new Set(arrayOfOccOptions.map(JSON.stringify)), JSON.parse);

        //Sort list of all posible occupancies combinations by num of rooms ASC
        arrayOfOccOptions = sortCombinationByNumOfRooms(arrayOfOccOptions)

        //sort an array according to children rules
        var n_children = parseInt($('#passengers_children').val());
        arrayOfOccOptions = childrenInRooms(arrayOfOccOptions, n_children);

        //Create list of values and option texts for rooms dropdown
        $("#room_occupancy").html(genListOfRoomOptions(arrayOfOccOptions));
        generateOccupancySummary(arrayOfOccOptions);
    });

    $('#room_occupancy').change(function () {
        generateOccupancySummary(arrayOfOccOptions);
        showchildDiscount();
    });

    $('#passengers_children').change(function () {
        showchildDiscount();
    });

    $('#passengers_infant').change(function () {
        var inf = $(this).val();
        if (inf > 0) {
            $('.infantPrice').fadeIn();
        } else {
            $('.infantPrice').fadeOut();
        }
    });

    $('#change_packBtn').click(function () {
        $('#modal').fadeOut();
        $('.priceTab').click();
        $('html,body').animate({
            scrollTop: $(".leftWrapper").offset().top
        }, 500);
    });

    //review stars
    $(".star_rating, #top_big_average,#big_average,#big_average_m").rateYo({
        starWidth: "15px",
        readOnly: true
    });

    if ($('.ratingSummary').length > 0) {
        $("#top_big_average,#big_average,#big_average_m").rateYo("rating", parseFloat($('#bigAv_val').html()));

        var dateToday = new Date();
        $(".ddatepicker").datepicker({
            dateFormat: 'yy-mm-dd',
            minDate: dateToday
        });
        $('.ui-datepicker').addClass('notranslate');

        $('#earliest_date').change(function () {
            var minDate = $(this).datepicker('getDate');
            $("#return_date").datepicker("change", {minDate: minDate});
        });

        $('#return_date').change(function () {
            var minDate = $(this).datepicker('getDate');
            $("#earliest_date").datepicker("change", {maxDate: minDate});
        });

        $('.ratingSummary').click(function () {
            $('html,body').animate({
                scrollTop: $(".reviewBoxTitle:visible").offset().top
            }, 1000);
        });
    }
    //$('#return_date').datep

    $('.request').click(function () {
        $('.priceTab').click();
        $('html,body').animate({
            scrollTop: $(".leftWrapper").offset().top - 100
        }, 500, function () {
            /*if($(window).width() < 640){
                $('.mainHeader').css({
                    top:0
                });
            }*/
        });
    });


    //TABS
    $('.tab').click(function () {
        $('.requestBtn').fadeIn();
        var tabIndex = $(this).index();
        $('.tab').removeClass('active');
        $(this).addClass('active');
        $('.tabContent').addClass('none');
        $('.tabContent').eq(tabIndex).removeClass('none');
        if ($(this).hasClass('priceTab')) {
            if ($(window).width() < 1024) {
                $('.requestBtn').fadeOut();
            }
        }
    });

    $(".priceTab").click(function () {
        var url = document.location.href;
        var result = removeURLParameter(url, "stab");
        if (result.indexOf("?") != -1) {
            result = result + "&stab=true";
        } else {
            result = result + "?stab=true";
        }
        history.pushState({urlPath: result}, "", result)
    });

    $('.close_box2').click(function () {
        $('#modal').fadeOut();
        if (multiple_requests != "") {
            window.location = multiple_requests;
        }
    });

    $('.modal_overlay').click(function () {
        $('#modal').fadeOut();
        $('#roomError').hide();
        $('#groupWarning').hide();
        $('#room_occupancy').show();
        $('#room_occupancy').css({
            border: 'none'
        });
        $('#submit_search').show();
        if (multiple_requests != "") {
            window.location = multiple_requests;
        }
    });

    $("#chooseAg").change(function () {
        var thisAgency = $(this).val();

        if (thisAgency != '') {
            $('#agentShow').show();
        } else {
            $('#agentShow').val('');
            $('#agentShow').hide();
        }

    });

    $(".departure_date").change(function () {
        var defaultdate = $(this).val();
        var tour_start_date = $(this).find(":selected").data('landdate');
        $('#tour_start_date').val(tour_start_date);
        $("#departure_date").val(defaultdate);
        $('#earliest_date').val(defaultdate);
        $('#return_date').val(defaultdate);

    });

    $("#flexible_dates").change(function () {
        var flex = $(this).val();
        if (flex == 'y') {
            $('.flex_date').show();
            $('.flex_date input').attr('required', 'required');
        } else {
            $('.flex_date').hide();
            $('.flex_date input').removeAttr('required');
        }
    });

    $('#modal-form #submit_search').click(function () {
        var parentDiv = $("#signup").parent();
        if ($("#signup").prop('checked') == false) {
            $("#signup").css({'border': '1px solid red'});
            $(parentDiv).css({"border-color": 'red'});
            var requiredCheckbox = "You must accept the terms and conditions to proceed.";
            if ($('#modal-form input[name="c_lang"]').val() == 'fr') {
                requiredCheckbox = "Vous devez accepter les termes et conditions pour continuer.";
            }
            $('#terms-error').html(requiredCheckbox).fadeIn();

        } else {
            $("#signup").css({"border": '1px solid #121f3d'});
            $(parentDiv).css({"border-color": '#ffffff'});
            $('#terms-error').html("").fadeIn();
        }
    });


    $('#modal-form').submit(function () {
        multiple_requests = window.location.href;
        /*validate airport code input*/
        var valid = true;
        var subdomain = $("#subdomain").val();
        var thisPage = $("#pageName").val();
        if ($("#airport_code").length > 0 && $("#airport_code").val() == '') {
            $(".departure_city").css({border: '1px solid red'});
            valid = false;
        }
        if ($("#departure_date").val() == '') {
            $(".departure_date").css({border: '1px solid red'});
            valid = false;
        }

        if ($("#signup").prop('checked') == false) {
            valid = false;
        }

        var thisForm = $(this);

        var comments = $('#special_requests').val();

        //Remove emojis
        comments = comments.replace(/([\uE000-\uF8FF]|\uD83C[\uDC00-\uDFFF]|\uD83D[\uDC00-\uDFFF]|[\u2011-\u26FF]|\uD83E[\uDD10-\uDDFF])/g, '');

        $('#special_requests').val(comments);


        if (valid && validateFields($('#modal-form'))) {
            //loading
            $("#sbmBooking").fadeOut();
            $("#loadBooking").fadeIn();

            var vars = $(this).serializeObject();
            var thisEmail = $('input[name="email"]', this);
            var thisConfirmation = $('input[name="c_email"]', this);
            var thisPhone = $('input[name="phone"]', this);
            $.ajax({
                url: '/ajax/bookingRequest.php',
                type: 'POST',
                timeout:20000,
                data: vars,
                success: function (response) {
                    response_a = response.split(":");

                    switch (response_a[0]) {
                        case 'EE':
                            $(thisEmail).css({'border': '1px solid red'});
                            alert(response_a[1]);
                            $("#loadBooking").fadeOut();
                            $("#sbmBooking").fadeIn();
                            //$('#sentMsg p').html(response_a[1]);
                            //$('#sentMsg').fadeIn();
                            break;
                        case 'EM':
                            $(thisEmail).css({'border': '1px solid red'});
                            $(thisConfirmation).css({'border': '1px solid red'});
                            alert(response_a[1]);
                            $("#loadBooking").fadeOut();
                            $("#sbmBooking").fadeIn();
                            //$('#sentMsg p').html(response_a[1]);
                            //$('#sentMsg').fadeIn();
                            break;
                        case 'URL':
                        case 'SPAM':
                        case 'HE':
                            //$('#sentMsg p').html(response_a[1]);
                            //$('#sentMsg').fadeIn();
                            alert(response_a[1]);
                            $("#loadBooking").fadeOut();
                            $("#sbmBooking").fadeIn();
                            break;
                        case 'SENT':
                            //$('#modal').hide();
                            //$(thisSendBtn).hide();
                            //$('#sentMsg p').html(response_a[1]);
                            //$('#sentMsg').fadeIn();
                            //alert(response_a[1]);
                            $('html, body').animate({scrollTop: 0}, 500);
                            $('#request_form').css({'top': '50px'});
                            $("#loadBooking").fadeOut();
                            $('#modal-form').fadeOut();
                            $('#errorBooking').html(response_a[2]).fadeIn();
                            //Event snippet for Lead AW conversion page
                            gtag('event', 'conversion', {
                                'send_to': 'AW-366705215/WlA_CLDzoa4DEL_07a4B',
                                'value': 0,
                                'transaction_id': response_a[1],
                                'currency': 'CAD'
                            });
                            gtag('set', 'user_data', {
                                "email": thisConfirmation.val(),
                                "phone_number": thisPhone.val()
                            });

                            if (subdomain !== 'www') {
                                var pushHistory = subdomain + "/request_sent" + thisPage;
                                ga('send', 'pageview', pushHistory);
                            }
                            // Submit Rakuten leads
                            let clientId = response_a[1];
                            let orderId = Date.now() + '-' + clientId;
                            let tourPrice = parseInt($('#tour_price').val());
                            let orderCurrency = $('#c_currency').val();
                            let productName = $('#package_name').val();
                            let salesQuantity = parseInt($('#passengers_adult').val()) + parseInt($('#passengers_children').val());
                            let packageCountry = orderCurrency === 'CAD' ? 'C' : 'U';
                            let requestLang = $('#c_lang').val();
                            switch($('#packege_category_id').val()){
                                case 2:
                                    packageCategory = 'C';
                                    break;
                                case 3:
                                    packageCategory = 'R';
                                    break;
                                default:
                                    packageCategory = 'T';
                            }
                            let sku = 'WB-' + packageCategory + '-' + requestLang.toUpperCase() + $('#tour_no').val() + '-' + packageCountry;

                            let rm_trans = {
                                affiliateConfig: {ranMID: "53123", discountType: "item", includeStatus: "false", taxRate: 5, removeTaxFromDiscount: true, tagType: "mop"},
                                orderid : orderId,
                                currency: orderCurrency,
                                conversionType: "Sale",
                                customerID: clientId,
                                lineitems : [{
                                    quantity : salesQuantity,
                                    unitPrice : tourPrice,
                                    SKU: sku,
                                    productName: productName,
                                }]
                            };
                            !function(a,b,c){
                                var d=a.rakutenDataLayerName||"DataLayer";a[d]=a[d]||{},a[d].events=a[d].events||{},a[d].events.SPIVersion="3.4.1",a[d].Sale=a[d].Sale||{},a[d].Sale.Basket=a[d].Sale.Basket||{},c.Ready=a[d].Sale.Basket.Ready&&a[d].Sale.Basket.Ready+1||1,a[d].Sale.Basket=c;
                                var e=function(a){for(var c,d=a+"=",e=b.cookie.split(";"),f=0;f<e.length;f++){for(c=e[f];" "==c.charAt(0);)c=c.substring(1,c.length);if(0==c.indexOf(d))return c.substring(d.length,c.length)}return""},f=function(a){var b=a||"",c={};if(a||(b=e("rmStore")),b){for(;b!==decodeURIComponent(b);)b=decodeURIComponent(b);for(var d=b.split("|"),f=0;f<d.length;f++)c[d[f].split(":")[0]]=d[f].split(":")[1]}return c},g={};g=f();var h=function(a,b,c,d){c=c||"",d=d||{};var e=g[a||""],f=d[b||""],h=d.ignoreCookie||!1;e=h?0:e;var i=e||f||c;return i=("string"!=typeof i||"false"!==i.toLowerCase())&&i,i},k=function(a,c,d,e,f){var g=b.createElement(a),h=-1<b.location.protocol.indexOf("s")?"https:":"http:";for(var i in c=c.replace("https:",h),g.src=c,e=e||{},"script"==a?e.type=e.type||"text/javascript":(e.style="display:none;","img"==a&&(e.alt="",e.height="1",e.width="1")),e)e.hasOwnProperty(i)&&g.setAttribute(i,e[i]);var j=b.getElementsByTagName(d);j=j.length?j[0]:b.getElementsByTagName("script")[0].parentElement,f&&(g.onload=f,g.onreadystatechange=function(){("complete"==this.readyState||"loaded"==this.readyState)&&f()}),j.appendChild(g)},l=function(a){var b=new Date,c=b.getUTCFullYear()+("0"+(b.getUTCMonth()+1)).slice(-2)+("0"+b.getUTCDate()).slice(-2)+("0"+b.getUTCHours()).slice(-2)+("0"+b.getUTCMinutes()).slice(-2);return"NoOID_"+(a?a+"_":"")+Math.round(1e5*Math.random())+"_"+c},m=function(){var b=a[d]&&a[d].Sale&&a[d].Sale.Basket?a[d].Sale.Basket:{},c=c||b.affiliateConfig||{},f=h("amid","ranMID","",c)||b.ranMID;if(!f)return!1;var g="undefined"==typeof c.allowCommission||"false"!==c.allowCommission;if(!g)return!1;if(!b.orderid&&!(b.lineitems&&b.lineitems.length))return!1;var m=h("adn","domain","track.linksynergy.com",c),o=h("atm","tagType","pixel",c),p=h("adr","discountType","order",c),q=h("acs","includeStatus","false",c),r=h("arto","removeOrderTax","false",c),s=h("artp","removeTaxFromProducts","false",c),t=h("artd","removeTaxFromDiscount","false",c),u=h("atr","taxRate",b.taxRate||0,c),v=h("ald","land",!1,{})||(c.land&&!0===c.land?e("ranLandDateTime"):c.land)||!1,w=h("atrv","tr",!1,{})||(c.tr&&!0===c.tr?e("ranSiteID"):c.tr)||!1,x=h("acv","centValues","true",c),y=h("ancc","nonCentCurrencies","JPY",c);u=Math.abs(+u);var z=(100+u)/100,A=b.orderid||l(f);A=encodeURIComponent(A);var B=b.currency||"";B=encodeURIComponent(B.toUpperCase());var C=!1;if(B&&y){y=(y+"").split(",");for(var D=0;D<y.length;D++)y[D]==B&&(C=!0)}var F=function(a){return C&&(a=Math.round(a)),x&&"false"!==x?(a*=100,a=Math.round(a)):a=Math.round(100*a)/100,a+""},G=b.taxAmount?Math.abs(+b.taxAmount):0,H=b.discountAmount?Math.abs(+b.discountAmount):0,I=b.discountAmountLessTax?Math.abs(+b.discountAmountLessTax):0;!I&&H&&t&&u&&(I=H/z),I=I||H;var J="ep";"mop"===o&&(J="eventnvppixel");var K=(b.customerStatus||"")+"",L="";K&&(q&&"EXISTING"==K.toUpperCase()||q&&"RETURNING"==K.toUpperCase())&&(L="R_");for(var M=[],N=0,O=0;O<(b.lineitems?b.lineitems.length:0);O++)if(b.lineitems[O]){var P=!1,Q=a.JSON?JSON.parse(JSON.stringify(b.lineitems[O])):b.lineitems[O],R=+Q.quantity||0,S=+Q.unitPrice||0,T=+Q.unitPriceLessTax,U=T||S||0;s&&u&&!T&&(U/=z);for(var V,W=R*U,X=0;X<M.length;X++)V=M[X],V.SKU===Q.SKU&&(P=!0,V.quantity+=R,V.totalValue+=W);P||(Q.quantity=R,Q.totalValue=W,M.push(Q)),N+=W}for(var Y="",Z="",$="",_="",aa={},O=0;O<M.length;O++){var Q=M[O],ba=encodeURIComponent(Q.SKU),ca=Q.totalValue,R=Q.quantity,da=encodeURIComponent(Q.productName)||"";"item"===p.toLowerCase()&&I&&(ca-=I*ca/N);var ea=Q.optionalData;for(var fa in ea)ea.hasOwnProperty(fa)&&(aa[fa]=aa[fa]||"",aa[fa]+=encodeURIComponent(ea[fa])+"|");Y+=L+ba+"|",Z+=R+"|",$+=F(ca)+"|",_+=L+da+"|"}Y=Y.slice(0,-1),Z=Z.slice(0,-1),$=$.slice(0,-1),_=_.slice(0,-1),I&&(I=F(I)),G&&(G=F(G)),I&&"order"===p.toLowerCase()&&(Y+="|"+L+"DISCOUNT",_+="|"+L+"DISCOUNT",Z+="|0",$+="|-"+I),r&&G&&(Y+="|"+L+"ORDERTAX",Z+="|0",$+="|-"+G,_+="|"+L+"ORDERTAX");var ga="https://"+m+"/"+J+"?mid="+f;ga+="&ord="+A,ga+=v?"&land="+v:"",ga+=w?"&tr="+w:"",ga+="&cur="+B,ga+="&skulist="+Y,ga+="&qlist="+Z,ga+="&amtlist="+$,ga+="&img=1",ga+="&spi="+a[d].events.SPIVersion,I&&"item"===p.toLowerCase()&&(ga+="&discount="+I);var ea=b.optionalData||{};for(var fa in b.discountCode&&(ea.coupon=b.discountCode),b.customerStatus&&(ea.custstatus=b.customerStatus),b.customerID&&(ea.custid=b.customerID),I&&(ea.disamt=I),ea)ea.hasOwnProperty(fa)&&(ga+="&"+encodeURIComponent(fa)+"="+encodeURIComponent(ea[fa]));for(var fa in aa)aa.hasOwnProperty(fa)&&(ga+="&"+encodeURIComponent(fa)+"list="+aa[fa].slice(0,-1),I&&"order"===p.toLowerCase()&&(ga+="|"),G&&r&&(ga+="|"));ga+="&namelist="+_;if(8000<ga.length){for(var ha=8000;0<ha;)if("&"==ga.charAt(ha)){ga=ga.slice(0,ha);break}else ha--;ga+="&trunc=true"}k("img",ga,"body")},n=function(){var b=a[d]&&a[d].Sale&&a[d].Sale.Basket?a[d].Sale.Basket:{},c=c||b.displayConfig||{},e=h("dmid","rdMID","",c);if(!e)return!1;if(!b.orderid&&!b.conversionType)return!1;var f=h("dtm","tagType","js",c),g=h("ddn","domain","tags.rd.linksynergy.com",c),j=h("dis","includeStatus","false",c),m=h("dcomm","allowCommission","notset",c),n=h("duup","useUnitPrice","false",c),o=h("drtp","removeTaxFromProducts","false",c),p=h("drtd","removeTaxFromDiscount","false",c),q=h("dtr","taxRate",b.taxRate||0,c),r="";"true"===m||!0===m||"1"===m||1===m?r="1":("false"===m||!1===m||"0"===m||0===m)&&(r="0"),f="js"===f||"if"===f||"img"===f?f:"js";var s="script";"if"===f?s="iframe":"img"===f&&(s="img"),("true"===n||!0===n||"1"===n||1===n)&&(n=!0);var t=(b.customerStatus||"")+"",u="";t&&j&&("EXISTING"==t.toUpperCase()||"RETURNING"==t.toUpperCase())&&(u="R_");var v=b.orderid;v||(v=l((b.conversionType+"").toLowerCase()+"_"+e)),v=encodeURIComponent(u+v);var w=encodeURIComponent(b.currency||""),x=0,y="";q=Math.abs(+q);var z=(100+q)/100,A=b.discountAmount?Math.abs(+b.discountAmount):0,B=b.discountAmountLessTax?Math.abs(+b.discountAmountLessTax):0;!B&&A&&p&&q&&(B=A/z),B=B||A,B=isNaN(B)?0:B;for(var C=0;C<(b.lineitems?b.lineitems.length:0);C++)if(b.lineitems[C]){var D=+b.lineitems[C].quantity,E=+b.lineitems[C].unitPriceLessTax*D;(!E||n)&&(o&&q?E=+b.lineitems[C].unitPrice/z*D:E=+b.lineitems[C].unitPrice*D),E=isNaN(E)?0:E,x+=E,y+=encodeURIComponent(b.lineitems[C].SKU)+","}x=Math.round(100*(x-B))/100,y=y.slice(0,-1);var F="https://"+g+"/"+f+"/"+e;F+="/?pt="+"conv",F+="&orderNumber="+v,F+="&spi="+a[d].events.SPIVersion,x&&(F+="&price="+x),w&&(F+="&cur="+w),r&&(F+="&tvalid="+r),y&&(F+="&prodID="+y),k(s,F,"body")},o=function(){var b=a[d]&&a[d].Sale&&a[d].Sale.Basket?a[d].Sale.Basket:{},c=b.searchConfig||{},e=1024,f=encodeURIComponent("...TRUNCATED"),g=h("smid","rsMID","",c);if(!g)return!1;var j=h("said","accountID","113",c),m=h("sclid","clickID","",c),n=encodeURIComponent(h("sct","conversionType",b.conversionType&&"sale"!==(b.conversionType+"").toLowerCase()?b.conversionType:"conv",c));k("script","https://services.xg4ken.com/js/kenshoo.js?cid="+g,"body",null,function(){var a={};if(a.conversionType=n,a.revenue=0,a.currency=encodeURIComponent(b.currency||"USD"),a.orderId=encodeURIComponent(b.orderid||l(n)),a.promoCode=encodeURIComponent(b.discountCode||""),m&&(a.ken_gclid=encodeURIComponent(m)),a.discountAmount=+(b.discountAmount||0),a.discountAmount=isNaN(a.discountAmount)?0:Math.abs(a.discountAmount),a.customerStatus=encodeURIComponent(b.customerStatus||""),a.productIDList="",a.productNameList="",b.lineitems&&b.lineitems.length){for(var c=0;c<b.lineitems.length;c++)b.lineitems[c]&&(a.revenue+=+(b.lineitems[c].unitPrice||0)*+b.lineitems[c].quantity,a.productIDList+=(b.lineitems[c].SKU||"NA")+",",a.productNameList+=(b.lineitems[c].productName||"NA")+",");a.revenue=Math.round(100*(a.revenue-a.discountAmount))/100,a.productIDList=encodeURIComponent(a.productIDList.slice(0,-1)),a.productNameList=encodeURIComponent(a.productNameList.slice(0,-1)),a.productIDList.length>e&&(a.productIDList=a.productIDList.substring(0,e-f.length)+f),a.productNameList.length>e&&(a.productNameList=a.productNameList.substring(0,e-f.length)+f)}kenshoo.trackConversion(j,g,a)})};a[d].SPI={readRMCookie:e,processRMStoreCookie:f,readRMStoreValue:h,sRAN:m,sDisplay:n,sSearch:o,addElement:k,rmStore:g},m(),n(),o()
                            }(window,document,rm_trans);
                            break;
                        default:
                            $('html, body').animate({scrollTop: 0}, 500);
                            $('#request_form').css({'top': '50px'});
                            $("#loadBooking").fadeOut();
                            $('#modal-form').fadeOut();
                            $('#errorBooking').html('FATAL ERROR. PLEASE CONTACT US').fadeIn();
                            break;
                    }
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
        } else {
            return false;
        }
    });


    var insert_counter = false;
    $('.getAirport').keydown(function (e) {

        var code = e.keyCode || e.which;
        if (code == 9 && $('#results_frame').html() != '') {
            //get first value
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
                    $('head').append("<script src=\"/js/all_airports.js?v=456\"></script>");
                    insert_counter = true;
                }
                result = getAirports(data_all.airports, q);
            }
            $('#results_frame').html(result);
        } else {
            $('#results_frame').html('');
        }
    });
});

/********** Body On Click: for dynamic elements *************/
//On Month change from pricing list, display prices of that month
$('html').on('change', '#month_prices', function () {
    if ($(this).val() == 'all') {
        $('.monthTable').show();
        $('.monthPriceRow').show();
    } else {
        $('.monthTable').hide();
        $('.monthPriceRow').hide();
        var thisClass = $(this).val()
        $('.' + thisClass).show();
        $('.date_table_wrap').css({
            'max-height': 'initial'
        });
    }
});

//On Click Make a Request from the Pricing list open the request Modal
$('html').on('click', ".book_by_date", function () {
    //reset avaliable occupancy to default values
    showLoading();
    avaliableOccupancies = {'Double': 2};
    arrayOfOccOptions = {0: {'Double': 1}};

    $('.departure_date').css({opacity: 1});
    $('.other_city').hide();
    $('.singl_price').hide();
    $('.triple_price').hide();
    $('#passengers_adult').val(2);
    $("#passengers_children").val(0);
    $("#room_occupancy").val(1);
    $('#doubleMsg b').html('1');
    $('#doubleMsg').show();
    $('#tripleMsg').hide();
    $('#singleMsg').hide();

    doubleOccPrice = $(this).data('price');

    category = $(this).data('category');
    category_id = $(this).data('catid');
    category = category.replace('-', ' ');
    let dep_date = $(this).data('date');
    selectedDepartureDate = $(this).data('date');
    let airport = $('.action_rates').children("option:selected").data('air');
    let tour_start_date = $(this).data('tourstartdate');
    let city = $('.action_rates').children("option:selected").html();
    let requestLang = $('#c_lang').val();
    $('#modal_cat').val(category_id);


    //get date list
    let defaultFilter = priceCurrency == 'USD' ? 'DFU' : 'DFC';
    $.ajax({
        url: '/ajax/site_functions.php',
        type: 'POST',
        data: {
            action: 'getDepartureDates',
            DEPC: airport,
            TOMSID: tomsid,
            DEF_FILTER: defaultFilter,
            requestLang: requestLang,
            OCCCATID: category_id
        },
        success: function (response) {
            $('.departure_date').html(response);
            $('.departure_date').attr('disabled', false);
            $('.departure_date').val(dep_date);
        }
    });
    var thisRequestButton = $(this);

    $.ajax({
        url: '/ajax/site_functions.php',
        type: 'POST',
        data: {
            action: 'getSingl',
            did: $(this).data('ddid'),
            curr: $('#q_currency').val(),
            cid: $(this).data('catid')
        },
        success: function (r) {
            r = JSON.parse(r);

            if (r.Single != 'not found') {
                singleOccPrice = r.Single;
                $('#singl_price').html(parseInt(singleOccPrice).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));

                // if single is avaliable create <opltion> for ddown and add values to array of avaliable occupancies
                var single_name = request_lang === 'en' ? 'Single' : 'Simple';
                avaliableOccupancies[single_name] = 1;
                arrayOfOccOptions[1] = {'Single': 2};

            } else {
                singleOccPrice = 'NA';
                $('#singl_price').html("");
            }
            if (r.Triple != 'not found') {
                tripleOccPrice = r.Triple;
                $('#triple_price').html(parseInt(tripleOccPrice).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                avaliableOccupancies['Triple'] = 3;
            } else {
                tripleOccPrice = 'NA';
                $('#triple_price').html("");
            }

            if (r.Quad != 'not found') {
                quadOccPrice = r.Quad;
                $('#quad_price').html(parseInt(quadOccPrice).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                avaliableOccupancies['Quadruple'] = 4;

            } else {
                quadOccPrice = 'NA';
                $('#quad_price').html("");
            }
            $("#room_occupancy").html(genListOfRoomOptions(arrayOfOccOptions));
            onRequestStatus(thisRequestButton.data('onrequest'));
            $('#selected_price').html(doubleOccPrice.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
            $('#hotel_category').val(category);
            $('#hotel_id').val(category_id);
            $('#selected_cat').html(category);
            $('#airport_code').val(airport);
            $('#departure_date').val(dep_date);
            $('#departure_city').val(city);
            $('.departure_city').val(city);
            $('.departure_city').attr('disabled', true);
            $('#tour_start_date').val(tour_start_date);
            $('#f_date').html($('.book_by_date').data('longdate'));
            $('#f_city').html(city);
            $('html, body').animate({scrollTop: 0}, 'slow');
            hideLoading();
            $('#modal').fadeIn();
        }
    });
});

/*Airport search*/
$('html').on('click', '.packRes p', function () {

    var code = $(this).data('code');
    var city = $(this).data('city');
    var country = $(this).data('country');

    var packid = $('input[name="tour_no"]').val();
    var showToms = $('#show_toms').val();
    $(".departure_city").val(city + ' (' + code + ')');
    $("#departure_city").val(city);
    $("#airport_code").val(code);

    if ($('#modal_cat').length == 0) {
        $('.departure_date').prop('disabled', false);
        $('.departure_date').css({opacity: 1});
    } else {
        $('#modal_cat').prop('disabled', false);
        $('#modal_cat').css({opacity: 1});
    }


    //change currency depending from which country is departure city
    /*if(country == 'Canada'){
        priceCurrency = 'CAD';
    }else{
        priceCurrency = 'USD';
    }
    $('#c_currency').val(priceCurrency);
    $('#q_currency').val(priceCurrency);
    */

    if ($('.departure_date').val() != '') {
        $('.departure_date').change();
    }

    $('.q_result').remove();
    if (!$('.departure_date').hasClass('ddatepicker')) {
        $.ajax({
            url: '/ajax/search_dates.php',
            type: 'POST',
            data: {
                code: code,
                packid: packid,
                curr: priceCurrency
            },
            success: function (r) {
                var res = r.split('%%%');
                if (res[0] == 'exist') {
                    var pn = location.pathname.split('-');
                    pn[pn.length - 1] = res[2];
                    var newPath = pn.join('-');
                    var link = location.protocol + '//' + location.host + newPath + '?depc=' + res[1] + '&stab=true';
                    window.location.href = link;
                }
            }
        });
    }
});
/************ FUNCTIONS **************/
function genListOfRoomOptions(arrayOfOccOptions) {

    var roomOptions = '';

    $.each(arrayOfOccOptions, function (index, rooms_option) {

        var tmp = Object.keys(this).map(k => this[k]);
        var n_rooms_per_option = tmp.reduce((a, b) => a + b, 0);

        var room_translation = 'ROOMS' ;
        if(index == 0 && n_rooms_per_option == 1 ){
            room_translation = room_translation.slice(0,-1);
        }
        var option_text = n_rooms_per_option + ' ' + room_translation + ' (';

        $.each(rooms_option, function (index, val) {
            option_text = option_text.concat(val, ' ', index, ', ');
        });

        option_text = option_text.replace(/,\s*$/, "");
        option_text = option_text.concat(')');

        roomOptions += '<option data-index="' + index + '" value="' + n_rooms_per_option + '">' + option_text + '</option>';
    });

    return roomOptions;
}

function onRequestStatus(requestStatus) {
    if (requestStatus != '0') {
        //Requests Only, price on website not available
        requestOnly = true;
        $('.priceSummaryRequest').hide();
        if ($('input[name="c_lang"]').val() == 'fr') {
            occ_summary = "SUR DEMANDE: 2 passagers dans 1 chambre";
        } else {
            occ_summary = "ON REQUEST: 2 pax in 1 room";
        }
        if (requestStatus == '1') {
            $('#request_type').val('DMC Limit');
        }
        if (requestStatus == '2') {
            $('#request_type').val('Flight Price');
        }
        if (requestStatus == '4') {
            $('#request_type').val('Category Sold Out');
        }

        $('#room_description').val(occ_summary);
        $('#room_config').val("1,0,0,0"); //double, triple, single
        $('#tour_price').val(doubleOccPrice);
        $('#tour_price').prop('required', true);
    } else {
        //Regular request with price on website
        requestOnly = false;
        $('#request_type').val('Available');
        $('.priceSummaryRequest').show();
        $('#tour_price').val(doubleOccPrice);
        $('#tour_price').prop('required', true);
    }
}

function removeURLParameter(url, parameter) {

    var urlparts = url.split('?');
    if (urlparts.length >= 2) {

        var prefix = encodeURIComponent(parameter) + '=';
        var pars = urlparts[1].split(/[&;]/g);

        for (var i = pars.length; i-- > 0;) {
            if (pars[i].lastIndexOf(prefix, 0) !== -1) {
                pars.splice(i, 1);
            }
        }

        return urlparts[0] + (pars.length > 0 ? '?' + pars.join('&') : '');
    }
    return url;
}

function showOtherModal() {
    //$('#modal_cat').val($('#hotel_id').val());
    $('.main_modal').hide();
    $('.other_modal').show();
    $('#tour_price').val('');
    $('#tour_price').removeAttr('required');
    //$('#hotel_category').val('');
    $('#departure_city').html('');
    $('.departure_date').val('');
    $('#modal-form .form_fill').not('.departure_city,input[type="hidden"]').css({opacity: 0.5});
    $('#modal-form .form_fill').not('.departure_city,.departure_date').prop('disabled', true);
    $('#modal-form input[type="submit"]').prop('disabled', true);
    //var tour_no = $('#modal').data('tour');
    $('html, body').animate({scrollTop: 0}, 'slow');
    $('#modal').fadeIn();

    if (selectedCity) {
        $(".action_rates").val(thisDepc);
    } else {
        $(".action_rates option:first").removeAttr('disabled');
        $(".action_rates").prop("selectedIndex", 0);
        $(".action_rates option:first").attr('disabled', 'disabled');
    }
}

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

function sortInternalArrays(arrayOfOptions) {

    $.each(arrayOfOptions, function (index, val) {
        val = Object.entries(val);
        val.sort((a, b) => a[0].localeCompare(b[0]));
        val = Object.fromEntries(val);
        arrayOfOptions[index] = val;
    });

    return arrayOfOptions;
}

function sortCombinationByNumOfRooms(arrayOfOptions) {

    arrayOfOptions = arrayOfOptions.sort(function (a, b) {
        var sum_a = Object.keys(a).map(k => a[k]);
        sum_a = sum_a.reduce((a, b) => a + b, 0);
        var sum_b = Object.keys(b).map(k => b[k]);
        sum_b = sum_b.reduce((a, b) => a + b, 0);
        return sum_a < sum_b ? -1 : 1;
    });

    return arrayOfOptions;
}

function childrenInRooms(arrayOfOptions, n_children) {

    var childrenInTriple = $('#triple_must_have_children').val();
    var childrenInQuad = $('#quad_must_have_children').val();

    for (var i = arrayOfOptions.length - 1; i >= 0; i--) {

        if (childrenInTriple == 1 && arrayOfOptions[i]['Triple'] > 0 && n_children < arrayOfOptions[i]['Triple']) {
            arrayOfOptions.splice(i, 1);
        }

        if ((childrenInQuad == 1 && arrayOfOptions[i]['Quadruple'] > 0) && n_children < arrayOfOptions[i]['Quadruple']) {
            arrayOfOptions.splice(i, 1);
        }

        if ((childrenInTriple == 1 && childrenInQuad == 1) && (arrayOfOptions[i]['Quadruple'] > 0 || arrayOfOptions[i]['Triple'] > 0) && n_children < (arrayOfOptions[i]['Quadruple'] + arrayOfOptions[i]['Triple'])) {
            arrayOfOptions.splice(i, 1);
        }

        if (n_children > 0 && Reflect.ownKeys(arrayOfOptions[i]).length == 1 && (typeof arrayOfOptions[i]['Single'] != 'undefined' || typeof arrayOfOptions[i]['Simple'] != 'undefined')) {
            arrayOfOptions.splice(i, 1);
        }
    }

    return arrayOfOptions;
};

function generateOccupancySummary(avaliableRooms) {
    let num_guests = parseInt($('#passengers_adult').val()) + parseInt($('#passengers_children').val());
    if (num_guests > 9) {
        $('#groupWarning').fadeIn();
    } else {
        $('#groupWarning').fadeOut();
    }

    if (requestOnly || num_guests > 9) {
        $('.priceSummaryRequest').slideUp();
    } else {
        $('.priceSummaryRequest').slideDown();
    }

    var selectedRooms = $('#room_occupancy').find(':selected');
    var selectedCombinationOfRooms = avaliableRooms[selectedRooms.data('index')];

    $('#doubleMsg').hide();
    $('#singleMsg').hide();
    $('#tripleMsg').hide();
    $('#quadMsg').hide();
    $('.singl_price').hide();
    $('.triple_price').hide();
    $('.quad_price').hide();

    var singleRooms = 0;
    var doubleRooms = 0;
    var tripleRooms = 0;
    var quadRooms = 0;
    var occ_summary = '';


    $.each(selectedCombinationOfRooms, function (index, value) {
        switch (index) {
            case 'Double':
                doubleRooms = value;
                $('#doubleMsg b').html(value);
                $('#doubleMsg').show();
                occ_summary = occ_summary + $('#doubleMsg').html().replace(/(<([^>]+)>)/gi, "") + "\n";

                break;
            case 'Triple':
                tripleRooms = value;
                $('#tripleMsg b').html(value);
                $('#tripleMsg').show();
                if (tripleOccPrice != 0) {
                    $('.triple_price').slideDown();
                    $('#triple_sup_price').val(parseInt(singleOccPrice));
                }
                occ_summary = occ_summary + $('#tripleMsg').html().replace(/(<([^>]+)>)/gi, "") + "\n";

                break;
            case 'Quadruple':
                quadRooms = value;
                $('#quadMsg b').html(value);
                $('#quadMsg').show();
                occ_summary = occ_summary + $('#quadMsg').html().replace(/(<([^>]+)>)/gi, "") + "\n";

                break;
            case 'Simple':
            case 'Single':
                singleRooms = value;
                $('#singleMsg b').html(value);
                $('#singleMsg').show();
                $('.singl_price').slideDown();
                $('#single_sup_price').val(parseInt(singleOccPrice));
                occ_summary = occ_summary + $('#singleMsg').html().replace(/(<([^>]+)>)/gi, "") + "\n";

                break;
        }

    });

    occ_config = doubleRooms + "," + tripleRooms + "," + singleRooms + "," + quadRooms; //double, triple, single

    if (requestOnly || num_guests > 9) {
        var total_rooms = parseInt(doubleRooms) + parseInt(tripleRooms) + parseInt(singleRooms) + parseInt(quadRooms);
        if (request_lang == 'fr') {
            occ_summary = "SUR DEMANDE: " + num_guests + " passagers dans " + total_rooms + " chambre(s)";
        } else {
            occ_summary = "ON REQUEST: " + num_guests + " pax in " + total_rooms + " room(s)";
        }
    }
    // total passenger more then 9 no room configurations
    if (num_guests > 9) {
        $('#room_config').val('0,0,0,0');
    } else {
        $('#room_config').val(occ_config);
    }

    $('#room_description').val(occ_summary);
}

function showchildDiscount() {
    var chldn = $('#passengers_children').val();
    var hasTripleOrQuad = false;

    var selectedRooms = $('#room_occupancy').find(':selected');
    var selectedCombinationOfRooms = arrayOfOccOptions[selectedRooms.data('index')];


    $.each(selectedCombinationOfRooms, function (index, value) {
        if (index == "Triple" || index == "Quadruple") {
            hasTripleOrQuad = true;
        }

    });

    if (chldn > 0 && hasTripleOrQuad) {
        $('.childDiscount').fadeIn();
    } else {
        $('.childDiscount').fadeOut();
    }
}

function generateCombinations(guests, rooms, current = []) {
    if (guests === 0) {
        arrayOfOccOptions.push(current.reduce(function (roomCounts, room) {
            roomCounts[room] = (roomCounts[room] || 0) + 1;
            return roomCounts;
        }, {}));
        return;
    }

    $.each(rooms, function (room, capacity) {
        if (capacity <= guests) {
            current.push(room);
            generateCombinations(guests - capacity, rooms, current);
            current.pop();
        }
    });
}

function validEmail(email) {
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

function hideRow() {

    var month = $('#month_prices').val();
    var cur_cat = $('#cat_prices').val();
    $('.pricingRow').hide();
    $('.' + cur_cat).show();
    $('.dep_price').css({
        background: '#FFF'
    });
    setTimeout(function () {
        $('.dep_price').css({
            background: '#f3deb7'
        });
        $('.monthTable').each(function () {
            if ($(this).find('.pricingRow.' + cur_cat).length == 0) {
                $(this).hide();
            } else {
                $(this).show();
            }
        });
        if (month == 'all') {
            $('.monthTable').show();

            //show Button
            $('.showAllPrices').show();
        } else {
            $('.monthTable').hide();
            var thisClass = month
            $('.' + thisClass).show();
            $('.date_table_wrap').css({
                'max-height': 'initial'
            });
            //hide button
            $('.showAllPrices').hide();

        }
    }, 600);

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

$.fn.serializeObject = function () {
    var formObj = {};
    var a = this.serializeArray();
    $.each(a, function () {
        if (formObj[this.name] !== undefined) {
            if (!formObj[this.name].push) {
                formObj[this.name] = [formObj[this.name]];
            }
            formObj[this.name].push(this.value || '');
        } else {
            formObj[this.name] = this.value || '';
        }
    });
    return formObj;
};