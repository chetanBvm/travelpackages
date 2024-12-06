<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        ul {
            padding-left: 17px !important;

        }

        p,
        li {
            font-size: 14px;
        }

        .footer-data {
            padding-top: 10px;
            display: flex;
            align-items: center;
            column-gap: 10px;
        }

        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
            color: #ffffff;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
            border-collapse: collapse;
        }

        .head-data span {
            font-weight: 500;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .head-data {
            display: flex;
            align-items: center;
            column-gap: 5px;
        }

        .invoice-box table tr.heading td {
            background: #E5A13D;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
            color: #ffffff;
            text-transform: uppercase;

        }

        .second-heading {
            display: grid;
        }

        .invoice-box tr td {
            color: #203638;
        }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table>



            <tr style="margin: 10px;">
                <td style="padding-top: 10px; text-align: end;" colspan="2">Quote Number:
                    #{{ $booking->transaction_id }}</td>
            </tr>
            <tr style="margin: 10px;">
                <td style="padding-top: 10px; padding-bottom:10px;" colspan="2">Hello {{ $booking->passenger_name }},
                </td>
            </tr>

            <tr>
                <td style="font-size: 14px; font-weight: 500;" colspan="2">Thank you for your interest in our
                    wonderful & hassle-free package to {{ $booking->package_name }}. My name is Felicia and I am the
                    person in charge of your package.
                    Please find below details of your package at the lowest rate guaranteed with a departure on
                    <strong>{{ $booking->departure_date }} from {{ $booking->departure_city }}</strong>. For any
                    questions, you can simply reply to this
                    email or call
                    me using the toll free number below.
                </td>
            </tr>
            <tr>
                <td style="font-size: 14px; font-weight: 600; color: #ff0000; " colspan="2">Please note availability
                    is limited and the price may fluctuate. In order to book, please call
                    us at your earliest convenience on our toll-free number at
                    <span style="font-size: 14px; font-weight: 600; color: #203638; ">1-877-919-8747</span>. Our hours
                    of operations are from 9:00 AM to 6:00 PM EST, Monday to
                    Friday.
                </td>
            </tr>
            <tr>
                <td style="font-size: 16px; font-weight: 600; padding-top: 20px;" class="head-data" colspan="2">
                    <strong>{{ $booking->package_name }}</strong>
                </td>
            </tr>
            <tr>
                <td style="font-size: 16px; font-weight: 600; " class="head-data" colspan="2">
                    <strong>Depart:</strong> <span>{{ $booking->departure_date }}</span>
                </td>
            </tr>
            {{-- <tr>
                <td style="font-size: 16px; font-weight: 600; padding-bottom: 20px;" class="head-data" colspan="2">
                    <strong>Return:</strong> <span>January 15 2025</span></td>
            </tr> --}}



            <tr class="heading">
                <td>TRIP DETAILS</td>
                <td></td>
            </tr>
            <tr style="margin: 10px;">
                <td style="padding-top: 20px;" class="second-heading">
                    <strong>Day 1: Flight Calgary (YYC) - Liberia (LIR)</strong>
                    <span>January 08 2025</span>
                </td>
            </tr>
            <tr style="margin: 10px;">
                <td style="padding-top: 10px;">
                    <p style="margin: 0px;">
                        Flight with a good itinerary. <br>
                        Arrival at the airport. You will be greeted by our local representatives after exiting the
                        customs
                        and transferred to your hotel.
                    </p>
                </td>
            </tr>


            <tr style="margin: 10px;">
                <td style="padding-top: 20px;" class="second-heading">
                    <strong>Day 1: Rincon de la Vieja</strong>
                    <span>January 08 2025</span>
                </td>
            </tr>

            <tr style="margin: 10px;">
                <td style="padding-top: 10px; padding-bottom: 20px;">
                    <p style="margin: 0px; ">
                        The rest of the day is free to relax at your hotel or explore Rincon de la Vieja.<br>
                        Rincón de la Vieja National Park is known for its stunning natural beauty with its volcano
                        geothermal activity, hot springs, and diverse wildlife. It's a popular destination for
                        eco-tourism
                        and adventure activities, offering hiking trails, waterfalls, and more!
                    </p>
                </td>
            </tr>


            <tr style="margin: 10px;">
                <td style="padding-top: 20px;" class="second-heading">
                    <strong>Day 2: Rincon de la Vieja</strong>
                    <span>January 09 2025</span>
                </td>
            </tr>

            <tr style="margin: 10px;">
                <td style="padding-top: 10px; padding-bottom: 20px;">
                    <p style="margin: 0px; ">
                        Breakfast at your hotel followed by a departure at around 8:00 A.M. for a full-day activity.
                        Today,
                        you will experience the traditions, flavors, and culture of Guanacaste in the Cultural Center
                        “El
                        Trapiche” where you will observe the artisanal process of extracting the juice from the sugar
                        cane and the preparation of different traditional sweets. You will indulge in a traditional
                        cuisine
                        and a gourmet coffee tasting. Afterward, you will also participate in the manufacturing of pre-
                        Colombian ceramics and develop your skills as a coffee expert. <br><br>
                        You will then enjoy the splendid tropical forest where you will explore the secrets of Mother
                        Nature and walk along the nature trails of the El Saino Nature Reserve through hanging bridges.
                        The hike will take approximately 40 minutes, depending on how much time you spend on each
                        of the 16 bridges with a maximum height of 20 meters, and will let you spot all the nature and
                        wildlife that the forest has to offer. Lunch will be served at La Montaña restaurant. Finally,
                        you
                        will relax at the Pacaya Hot Springs and Spa in the foothills of Rincon de la Vieja Volcano
                        National Park. Return to your hotel for a dinner at leisure. Overnight in Rincon de la Vieja.
                        (Breakfast - Lunch)
                    </p>
                </td>
            </tr>


            <tr style="margin: 10px;">
                <td style="padding-top: 20px;" class="second-heading">
                    <strong>Day 3: Rincon de la Vieja</strong>
                    <span>January 10 2025</span>
                </td>
            </tr>

            <tr style="margin: 10px;">
                <td style="padding-top: 10px; padding-bottom: 20px;">
                    <p style="margin: 0px; ">
                        After breakfast at your hotel, you will be transferred to a cooking class experience lasting
                        around
                        1 hour and you will be picked up at Buena Vista del Rincon lobby of the Hotel. That highlights
                        the rich culinary heritage of the country. Costa Rican cuisine is known for its use of fresh,
                        locally
                        sourced ingredients and simple yet flavorful dishes. During the cooking class, guests may have
                        the opportunity to learn how to prepare traditional Costa Rican dishes such as gallo pinto (a
                        popular rice and beans dish). Transfer back to your hotel for lunch and then have the rest of
                        the
                        day at leisure. (Breakfast – Lunch)
                    </p>
                </td>
            </tr>


            <tr style="margin: 10px;">
                <td style="padding-top: 20px;" class="second-heading">
                    <strong>Day 4: Rincon de la Vieja – Tamarindo</strong>
                    <span>January 11 2025</span>
                </td>
            </tr>

            <tr style="margin: 10px;">
                <td style="padding-top: 10px; padding-bottom: 20px;">
                    <p style="margin: 0px; ">
                        Enjoy breakfast at the hotel before getting transferred to Tamarindo, one of the most beautiful
                        corners of Costa Rica. You will have a day at leisure to discover this lively beach town that
                        combines high-end shopping, fine dining, and lively nightlife with amazing scenery. (Breakfast)
                    </p>
                </td>
            </tr>




            <tr style="margin: 10px;">
                <td style="padding-top: 20px;" class="second-heading">
                    <strong>Day 5: Tamarindo</strong>
                    <span>January 12 2025</span>
                </td>
            </tr>

            <tr style="margin: 10px;">
                <td style="padding-top: 10px; padding-bottom: 20px;">
                    <p style="margin: 0px; ">
                        Breakfast at the hotel. Today wake up to the incredible views of Tamarindo and enjoy a day at
                        leisure. You will have the option to relax at the golden sandy beaches of Tamarindo, stroll
                        through the town’s vibrant shops, or enjoy delicious seafood at beachfront restaurants. This
                        town truly embodies the "Pura Vida" lifestyle, representing the laid-back and positive approach
                        to life in Costa Rica. (Breakfast)
                    </p>
                </td>
            </tr>


            <tr style="margin: 10px;">
                <td style="padding-top: 20px;" class="second-heading">
                    <strong>Day 6: Tamarindo – Optional Catamaran Sailing Sunset half-day tour ($)</strong>
                    <span>January 13 2025</span>
                </td>
            </tr>

            <tr style="margin: 10px;">
                <td style="padding-top: 10px; padding-bottom: 20px;">
                    <p style="margin: 0px; ">
                        Breakfast at your hotel. Today, immerse yourself in the culture of Costa Rica. Explore more in-
                        depth the beauty of Tamarindo town or relax at your hotel. You can also opt for an optional
                        half-
                        day Catamaran Sailing Sunset tour ($). (Breakfast)
                    </p>
                </td>
            </tr>


            <tr style="margin: 10px;">
                <td style="padding-top: 10px; padding-bottom: 20px;">
                    <span style="text-decoration: underline;">Optional Catamaran Sailing Sunset half-day tour
                        ($):</span>
                    <p style="margin: 0px; padding-top: 10px; ">

                        Join the group at a meeting point near the beach area. You will be sailing to one of the many
                        pristine beaches in the area. On the way, you will be likely able to admire marine wildlife,
                        especially turtles, dolphins, flying fish or whales. The crew will provide snorkel equipment and
                        you will practice it for one hour approximately, looking for exotic sea life. You will also
                        enjoy a
                        varied lunch as well as an open bar including sodas, juices, beers, and some liquors. After
                        lunch, you will return to the bay for a beautiful sunset along the beach shore. Once you finish,
                        make your way to your hotel for the evening in Tamarindo.
                    </p>
                </td>
            </tr>


            <tr style="margin: 10px;">
                <td style="padding-top: 20px;" class="second-heading">
                    <strong>Day 7: Tamarindo – Liberia</strong>
                    <span>January 14 2025</span>
                </td>
            </tr>

            <tr style="margin: 10px;">
                <td style="padding-top: 10px; padding-bottom: 20px;">
                    <p style="margin: 0px; ">
                        Following your breakfast at the hotel, you will transfer out of Tamarindo back to Liberia at
                        around
                        2 P.M. After check-in at the hotel, take the rest of the day to enjoy the facilities of your
                        hotel or
                        explore the city surrounded by diverse shops and dining. You can explore Liberia's local markets
                        such as Mercado Municipal where you can find fresh produce, handmade crafts, and local
                        snacks (Breakfast)
                    </p>
                </td>
            </tr>


            <tr style="margin: 10px;">
                <td style="padding-top: 20px;" class="second-heading">
                    <strong>Day 8: Flight Liberia (LIR) - Calgary (YYC)</strong>
                    <span>January 15 2025</span>
                </td>
            </tr>

            <tr style="margin: 10px;">
                <td style="padding-top: 10px; padding-bottom: 20px;">
                    <p style="margin: 0px; ">
                        After breakfast, greeting in the lobby of your hotel by our local representatives and transfer
                        to
                        the airport for your flight home. (Breakfast).
                    </p>
                </td>
            </tr>

            <tr style="margin: 10px;">
                <td style="padding-top: 10px; padding-bottom: 20px;">
                    <p style="margin: 0px; ">
                        -End of services-
                    </p>
                </td>
            </tr>

            <tr class="heading">
                <td>Package Price</td>
                <td></td>
            </tr>

            <tr style="margin: 10px;">
                <td style="font-size: 16px; font-weight: 600; padding-top: 20px;">Room 1: (double occupancy)</td>
            </tr>

            <tr style="margin: 10px;">
                <td style="font-size: 16px; font-weight: 500; ">$3,398.00 CAD</td>
            </tr>
            <tr>
                <td style="font-size: 14px; font-weight: 600; color: #ff0000; border-bottom: 1px solid rgb(177, 177, 177);"
                    colspan="2">$100.00 CAD: BLACK FRIDAY - Book by December 4th (May sell
                    out earlier) - Applicable on a new booking made between November 14th and December 4th 2024
                    inclusively.</td>
            </tr>

            <tr style="margin: 10px;">
                <td style="font-size: 16px; font-weight: 500; padding-top: 10px;">2x $3,298.00 CAD</td>
            </tr>


            <tr>
                <td style="font-size: 16px; font-weight: 600; align-items: end; padding: 20px 0px;" class="head-data"
                    colspan="2"> <strong style="font-size: 40px; font-weight: bold;">$6,596.00 CAD</strong>
                    <strong>taxes included</strong>
                </td>
            </tr>


            <tr style="margin: 10px;">
                <td style="padding-top: 20px;" class="second-heading">
                    <strong>Payment:</strong>
                    <p>The full amount is due at reservation.</p>
                </td>
            </tr>


            <tr style="margin: 10px;">
                <td style="padding-top: 10px;" class="second-heading">
                    <strong>Addons:</strong>
                    <ul>
                        <li>Catamaran Sailing sunset tour: + $205.00 CAD p.p. <br>
                            Join the group at a meeting point near the beach area. You will be sailing to one of the
                            many pristine beaches in the area. On the way, you will be likely able to admire marine
                            wildlife, especially turtles, dolphins, flying fish or whales. The crew will provide snorkel
                            equipment and you will practice it for one hour approximately, looking for exotic sea life.
                            You will also enjoy a varied lunch as well as an open bar including sodas, juices, beers,
                            and some liquors. After lunch, you will return to the bay for a beautiful sunset along the
                            beach shore. Once you finish, make your way to your hotel for the evening in Tamarindo.
                        </li>
                    </ul>
                </td>
            </tr>


            <tr style="margin: 10px;">
                <td style="padding-top: 10px;" class="second-heading">
                    <strong>Includes:</strong>
                    <ul>
                        <li>Round-trip international flights between Calgary (YYC) / Liberia (LIR) with good itineraries
                        </li>
                        <li>Greetings and transfers between the airport & the hotels</li>
                        <li>7 nights hotel accommodations</li>
                        <li>All breakfasts + 2 lunches (9 meals)</li>
                        <li>Visits and entrance fees as per itinerary</li>
                        <li>All taxes, fees, and OPC</li>
                    </ul>
                </td>
            </tr>

            <tr style="margin: 10px;">
                <td style="padding-top: 10px;" class="second-heading">
                    <strong>Hotels:</strong>
                    <p style="margin: 0;padding-top: 10px;">3 nights in Rincon De La Vieja at the Buena Vista del
                        Rincon Eco Adventure 3* hotel (or similar)
                        in a standard room</p>
                    <p style="margin: 0;">3 nights in Tamarindo at the Wyndham Tamarindo 3.5* hotel (or similar) in a
                        standard room</p>
                    <p style="margin: 0;">1 night in Liberia at the Hampton by Hilton Guanacaste Airport 3.5* hotel (or
                        similar) in a
                        standard room</p>
                </td>
            </tr>

            <tr style="margin: 10px;">
                <td style="padding-top: 10px;" class="second-heading">
                    <strong>Excludes:</strong>
                    <ul>
                        <li>Travel insurance</li>
                        <li>Fees for checked baggage</li>
                        <li>Tips: Guides, bus drivers and hotel staff</li>
                        <li>Meals and beverages unless otherwise mentioned</li>
                        <li>Personal expenses and optional activities</li>
                    </ul>
                </td>
            </tr>


            <tr style="margin: 10px;">
                <td style="padding-top: 10px;" class="second-heading">
                    <strong>To complete your reservation, please contact us on our toll-free number at: <span
                            style="color: #E5A13D;">1-877-919-TRIP (8747)</span>.</strong>

                </td>
            </tr>
            <tr style="margin: 10px;">
                <td style="padding-top: 10px;" class="second-heading">
                    <strong>For questions, simply let us know as soon as possible by replying to this email.</strong>

                </td>
            </tr>

            <tr style="margin: 10px;">
                <td style="padding-top: 10px;" class="second-heading">
                    <p style="margin: 0;padding-top: 10px;">Please note that our hours of operation are from Monday to
                        Friday between 09:00AM and
                        6:00PM Eastern Standard Time.</p>
                </td>
            </tr>
            <tr>
                <td style="font-size: 14px; font-weight: 600; color: #ff0000; " colspan="2">$**Prices and
                    availability are subject to change. Only a reservation would confirm this
                    package at this price. Please advise.**</td>
            </tr>
            <tr>
                <td colspan="2">
                    <p>Looking forward to your reply or to your call to complete your reservation! <br>
                        Best regards,
                    </p>
                </td>
            </tr>



            <tr style="margin: 10px;">
                <td class="second-heading">
                    <span>Felicia</span>
                </td>
            </tr>

            <tr>
                <td
                    style="display: flex; align-items: center; border-bottom: 1px solid rgb(177, 177, 177); padding-bottom: 10px;">
                    <strong>Toll-free:</strong> <span>1-877-919-8747 (TRIP)</span>
                </td>
            </tr>

            <tr>
                <td style=" padding: 10px 0px; ">
                    <div class="footer-data">
                        <img src="./images/logo.png">
                        <div style="display: grid;">
                            <span>Myvacayhost.com - Where Vacation Dreams Come True</span>
                            <span><strong>Toll-free: </strong>1-877-919-8747 (TRIP)</span>
                            <div style="display: flex; align-items: center; column-gap: 10px;">
                                <a href="mailto:account@myvacayhost.com"
                                    style="border-right:1px solid #203638; color: #203638; font-size: 14px; padding-right: 5px;">account@myvacayhost.com</a>
                                <a href="#" style="color: #203638; font-size: 14px; ">myvacayhost.com</a>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
