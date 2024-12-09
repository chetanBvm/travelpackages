<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approve Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0">Approve Booking</h3>
                    </div>
                    <div class="card-body">
                        <!-- Booking Details -->
                        <h5 class="mb-3">Booking Details</h5>
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>Client Name</th>
                                    <td>{{$bookings->passenger_name}}</td>
                                </tr>
                                <tr>
                                    <th>Booking Date</th>
                                    <td>{{$bookings->departure_date}}</td>
                                </tr>
                                <tr>
                                    <th>Price</th>
                                    <td>{{$package->price}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
