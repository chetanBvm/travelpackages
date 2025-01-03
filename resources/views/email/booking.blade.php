<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap"
        rel="stylesheet">
    <title>Invoice</title>
    <style>
        ul {
            padding-left: 17px !important;
        }

        p,
        li {
            font-size: 14px;
        }

        .head-data span {
            font-weight: 500;
        }

        .head-data {
            display: flex;
            align-items: center;
            column-gap: 5px;
        }
    </style>
</head>

<body style="font-family:sans-serif;margin:0; padding: 20px; ">
    <div
        style="max-width: 800px;margin: auto;padding: 20px;border: 1px solid #eee;box-shadow: 0 0 10px rgba(0, 0, 0, 0.15); font-size: 16px;line-height: 24px;">
        <table style="width: 100%;line-height: inherit;text-align: left;border-collapse: collapse;">
            <tr style="margin: 10px;">
                <td style="padding-top: 10px; text-align: end;">Quote Number: #{{$booking->transaction_id}}</td>
            </tr>
            <tr style="margin: 10px;">
                <td style="padding-top: 10px; padding-bottom:10px;">Hello {{ $booking->passenger_name }},</td>
            </tr>

            <tr>
                <td style="font-size: 14px; font-weight: 500;">Thank you for your interest in our wonderful &
                    hassle-free package to {{ $booking->package_name }}, "{{ $booking->package_name }}".Please find below details of your package at the lowest rate guaranteed with a departure on
                    <b>{{ $booking->departure_date }} from {{ $booking->departure_city }}</b>. For any questions, you can simply reply to this email or call
                    me using the toll free number below.
                </td>
            </tr>
            <tr>
                <td style="font-size: 14px; font-weight: 600; color: #ff0000; ">Please note availability is limited and
                    the price may fluctuate. In order to book, please call
                    us at your earliest convenience on our toll-free number at
                    <span style="font-size: 14px; font-weight: 600; color: #203638; ">{{$contact->toll_number}}</span>. Our hours
                    of operations are from 9:00 AM to 6:00 PM EST, Monday to
                    Friday.
                </td>
            </tr>
            <tr>
                <td style="font-size: 16px; font-weight: 600; padding-top: 20px;" class="head-data"> <b>{{ $booking->package_name }}</b></td>
            </tr>
            <tr>
                <td style="font-size: 16px; font-weight: 600; " class="head-data"> <b>Depart:</b> <span>{{ $booking->departure_date }}</span></td>
            </tr>
            <tr>
                <td style="font-size: 16px; font-weight: 600; padding-bottom: 20px;" class="head-data"> <b>Return:</b>
                    <span>January 15 2025</span></td>
            </tr>



            <tr>
                <td style="background-color: #E5A13D; padding: 8px; color: white; font-weight: bold;">TRIP DETAILS</td>
                {{-- {!! $package->itinerary !!} --}}
            </tr>            
          

            <tr>
                <td style="background-color: #E5A13D; padding: 8px; color: white; font-weight: bold;">Package Price</td>

            </tr>

            <tr>
                <td style="font-size: 16px; font-weight: 600; padding-top: 20px;">
                    {{$booking->room_occupancy}}</td>
            </tr>

            <tr>
                <td style="font-size: 16px; font-weight: 500; ">$3,398.00 CAD</td>
            </tr>
            <tr>
                <td
                    style="font-size: 14px; font-weight: 600; color: #ff0000; border-bottom: 1px solid rgb(177, 177, 177);">
                    {{$info->header_title}}</td>
            </tr>

            <tr>
                <td style="font-size: 16px; font-weight: 500; padding-top: 10px;">2x $3,298.00 CAD</td>
            </tr>


            <tr>
                <td style="font-size: 16px; font-weight: 600; align-items: end; padding: 20px 0px;" class="head-data">
                    <b style="font-size: 40px; font-weight: bold;">$6,596.00 CAD</b> <b>taxes included</b></td>
            </tr>


            <tr>
                <td style="padding-top: 20px;">
                    <b>Payment:</b>
                    <p>The full amount is due at reservation.</p>
                </td>
            </tr>


            <tr>
                <td style="padding-top: 10px;">
                    <b>Addons:</b>
                    <p style="margin: 0;">
                        Catamaran Sailing sunset tour: + $205.00 CAD p.p. <br>
                        Join the group at a meeting point near the beach area. You will be sailing to one of the
                        many pristine beaches in the area. On the way, you will be likely able to admire marine
                        wildlife, especially turtles, dolphins, flying fish or whales. The crew will provide snorkel
                        equipment and you will practice it for one hour approximately, looking for exotic sea life.
                        You will also enjoy a varied lunch as well as an open bar including sodas, juices, beers,
                        and some liquors. After lunch, you will return to the bay for a beautiful sunset along the
                        beach shore. Once you finish, make your way to your hotel for the evening in Tamarindo.

                        </up>
                </td>
            </tr>


            <tr>
                <td style="padding-top: 10px;">
                    <b>Includes:</b>

                    {!! $package->inclusion !!}

                </td>
            </tr>

            <tr>
                <td style="padding-top: 10px;">
                    <b>Hotels:</b>
                    <p style="margin: 0;padding-top: 10px;">3 nights in Rincon De La Vieja at the Buena Vista del Rincon
                        Eco Adventure 3* hotel (or similar)
                        in a standard room</p>
                    <p style="margin: 0;">3 nights in Tamarindo at the Wyndham Tamarindo 3.5* hotel (or similar) in a
                        standard room</p>
                    <p style="margin: 0;">1 night in Liberia at the Hampton by Hilton Guanacaste Airport 3.5* hotel (or
                        similar) in a
                        standard room</p>
                </td>
            </tr>

            <tr>
                <td style="padding-top: 10px;">
                    <b>Excludes:</b>
                    {!! $package->exclusion !!}
                </td>
            </tr>


            <tr>
                <td style="padding-top: 10px;">
                    <b>To complete your reservation, please contact us on our toll-free number at: <span
                            style="color: #E5A13D;">{{$contact->toll_number}}</span>.</b>

                </td>
            </tr>
            <tr>
                <td style="padding-top: 10px;">
                    <b>For questions, simply let us know as soon as possible by replying to this email.</b>

                </td>
            </tr>

            <tr>
                <td style="padding-top: 10px;">
                    <p style="margin: 0;padding-top: 10px;">Please note that our hours of operation are from Monday to
                        Friday between 09:00AM and
                        6:00PM Eastern Standard Time.</p>
                </td>
            </tr>
            <tr>
                <td style="font-size: 14px; font-weight: 600; color: #ff0000; ">$**Prices and availability are subject
                    to change. Only a reservation would confirm this
                    package at this price. Please advise.**</td>
            </tr>
            <tr>
                <td>
                    <p>Looking forward to your reply or to your call to complete your reservation! <br>
                        Best regards,
                    </p>
                </td>
            </tr>



            <tr>
                <td>
                    <span>Felicia</span>
                </td>
            </tr>

            <tr>
                <td style= "border-bottom: 1px solid rgb(177, 177, 177); padding-bottom: 10px;">
                    <b>Toll-free:</b> <span>{{$contact->toll_number}}</span>
                </td>
            </tr>

            <tr style=" border-top: 1px solid rgb(177, 177, 177); padding-top: 10px;">
                <td style=" padding: 10px 0px; ">



                    <span>Myvacayhost.com - Where Vacation Dreams Come True</span> <br>
                    <span><b>Toll-free: </b>{{$contact->toll_number}}</span><br>

                    <a href="#"
                        style="border-right:1px solid #203638; color: #203638; font-size: 14px; padding-right: 5px;">account@myvacayhost.com</a>
                    <a href="#" style="color: #203638; font-size: 14px; ">myvacayhost.com</a>

                </td>
            </tr>
        </table>
    </div>
</body>

</html>
