<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html charset=UTF-8" />
    <title>pacakge Details</title>
    <style>
        .invoice-box table td {
            vertical-align: top;
        }

        .invoice-box table tr.heading td {
            background: #E5A13D;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
            color: #ffffff;
        }
    </style>
</head>

<body style="font-family: Arial, sans-serif;margin: 0;padding: 20px;">
    <div
        style="max-width: 800px;margin: auto;padding: 20px;border: 1px solid #eee;box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);font-size: 16px;line-height: 24px;color: #203638;">
        <table style="width: 100%; line-height: inherit;text-align: left;border-collapse: collapse;">
            <tr>
                @php
                    $images = json_decode($logo, true);
                @endphp               
                <td style="vertical-align: middle;">
                    @if (isset($images))
                        <img src="{{ asset('storage/' . $images['home']) }}" style="width: 100%; max-width: 150px;" alt="Company Logo">
                    @endif
                </td>
                <td style="vertical-align: top; text-align: right;">
                    <b>Myvacayhost</b><br>
                    <span>Flight with a good itinerary.Arrival at the airport.</span>
                </td>
            </tr>
            <tr>
                <td colspan="2"><img src="{{ asset('storage' . '/' . $package->thumbnail) }}" style="width: 100%; ">
                </td>
            </tr>
            <tr>
                <td colspan="2"><span
                        style="font-size: 22px; font-weight: 600; padding: 20px 0px; color: #000000;">{{ $package->name }}</span>
                </td>
            </tr>



            <tr class="heading">
                <td><span style="font-weight: 600; font-size: 16px;">Itinerary</span>
                    <span style="font-weight: 500; font-size: 14px;">{{ $package->days }}</span>
                </td>
                <td></td>
            </tr>
            <tr>
                {!! $package->itinerary !!}
            </tr>
            <tr>
                <td style=" padding: 10px 0px;" colspan="2">
                    <img src="{{ asset('storage/' . $package->map_image) }}" style="max-width: 600px;">
                </td>
            </tr>


            <tr>
                <td style="padding-top: 10px;" colspan="2">
                    <b>Includes:</b>
                    {!! $package->inclusion !!}
                </td>
            </tr>


            <tr>
                <td style="padding-top: 10px;" colspan="2">
                    <b>Excludes:</b>
                    {!! $package->exclusion !!}
                </td>
            </tr>


            <tr>
                <td style="padding-top: 10px;" colspan="2">
                    <b>Accommodation:</b>
                    {!! $package->accommodation !!}
                </td>
            </tr>

            {{-- <tr>
                <td style="padding-top: 10px;" colspan="2">
                    <b>Extras:</b>
                    <div>
                        <b>Catamaran Sailing sunset tour</b>
                        <span>+ 205.00 CAD</span>
                    </div>

                    <p style="margin: 0px; padding: 10px 0px;">
                        Join the group at a meeting point near the beach area. You will be sailing to one of the
                        many pristine beaches in the area. On the way, you will be likely able to admire marine
                        wildlife, especially turtles, dolphins, flying fish or whales. The crew will provide snorkel
                        equipment and you will practice it for one hour approximately, looking for exotic sea life.
                        You will also enjoy a varied lunch as well as an open bar including sodas, juices, beers,
                        and some liquors. After lunch, you will return to the bay for a beautiful sunset along the
                        beach shore. Once you finish, make your way to your hotel for the evening in Tamarindo.
                    </p>
                </td>
            </tr> --}}

            <tr style=" border-top: 1px solid rgb(177, 177, 177); padding-top: 10px;">
                <td style=" padding: 10px 0px; " colspan="2">
                    <span>Myvacayhost.com - Where Vacation Dreams Come True</span> <br>
                    <span><b>Toll-free: </b>1-877-919-8747 (TRIP)</span> <br>

                    <a href="#"
                        style="border-right:1px solid #203638; color: #203638; font-size: 14px; padding-right: 5px;">account@myvacayhost.com</a>
                    <a href="#" style="color: #203638; font-size: 14px; ">myvacayhost.com</a>
                </td>
            </tr>

        </table>
    </div>
</body>

</html>
