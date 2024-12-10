<!DOCTYPE html>
<html>
<head>
    <title>Package Details</title>
    <style>
        /* Add your PDF-specific styles here */
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
    <img src="{{ asset('storage/' .  $package->thumbnail) }}" />
    <h1>Package Details: {{ $package->name }}</h1>
    
    <h2>Inclusions</h2>
    <ul>
        @foreach ($package->inclusions as $inclusion)
            <li>{!! $inclusion->description !!}</li>
        @endforeach
    </ul>

    <h2>Exclusions</h2>
    <ul>
        @foreach ($package->exclusions as $exclusion)
            <li>{!! $exclusion->description !!}</li>
        @endforeach
    </ul>

    <h2>Accommodation</h2>
    <p>{!! $package->accommodation ?? 'No details available' !!}</p>
</body>
</html>
