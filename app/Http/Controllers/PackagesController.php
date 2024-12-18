<?php

namespace App\Http\Controllers;

use App\Models\Airport;
use App\Models\Banner;
use App\Models\ContentManagement;
use App\Models\Country;
use App\Models\DepartureCity;
use App\Models\DepartureFlights;
use App\Models\Destination;
use App\Models\Exclusions;
use App\Models\Inclusions;
use App\Models\Itinerary;
use App\Models\Package;
use App\Models\PackageImages;
use App\Models\PackageReview;
use App\Models\PackageType;
use App\Models\Promotion;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PackagesController extends Controller
{
    public function tourPackages()
    {
        $data['package'] = Package::with('destination.country')->paginate(20);
        $data['banner'] = Banner::where('type', 'Packages')->first();
        $data['country'] = Country::get();
        $data['packageType'] = PackageType::get();
        $data['social_link'] = ContentManagement::where('type', 'home_topbar')->first();
        $data['social_links'] = ContentManagement::where('type', 'home_topbar')->where('keywords','!=','main_title')->get();
        return view('web.packages.tourpackages', compact('data'))->with('filteredPackages', collect());
    }
    /**
     * @return  int $id 
     * use for the getting package detail data 
     */
    public function packageDetail(int $id)
    {
        $packages = Package::with('images')->findOrFail($id);
        $data['packageImages'] = PackageImages::where('package_id', $id)->get();
        $data['packages'] = Package::get()->take(3);
        $data['feature'] = Package::get()->take(10);
        $data['itinerary'] = Itinerary::where('package_id', $id)->first();
        $data['airport'] = Airport::get();
        $data['country'] = Country::get();
        $data['coupon'] = Promotion::get();
        $data['review'] = PackageReview::where('package_id', $id)->get();
        $data['inclusion'] = Inclusions::where('package_id', $id)->where('status', 'Active')->first();
        $data['exclusion'] = Exclusions::where('package_id', $id)->where('status', 'Active')->first();
        $data['destination'] = Destination::with('country')->get();
        $data['departureFlight'] = DepartureFlights::with('package.destination')->get();
        $data['departureCities'] = DepartureCity::get();
        $data['social_link'] = ContentManagement::where('type', 'home_topbar')->first();
        $data['social_links'] = ContentManagement::where('type', 'home_topbar')->where('keywords','!=','main_title')->get();
        $data['departureCity'] = DepartureCity::get()->take(5);
        return view('web.packages.packagedetail', compact('packages', 'data'));
    }

    /**
     * Downlaod the pdf for the accomendation or inclusion
     */
    public function downloadPdf($id)
    {
        $package = Package::with(['inclusions', 'exclusions'])->findOrFail($id);

        // Share data with the Blade view
        $data = [
            'package' => $package,
        ];

        // Load the Blade view and pass the data
        $pdf = Pdf::loadView('web.packages.pdf.package', $data);

        // Download the PDF with a custom name
        return $pdf->download('package-details.pdf');
    }

    public function getDepartureFlight(Request $request)
    {
       
        $depCityId = $request->DEPC;  // The selected city ID
        $selectedMonth = $request->month ?? null;  // Optional: The selected month
        $category = $request->CAT;
        
        $cityData = Destination::with('country')->where('id',$depCityId)->first();
        $countryName = $cityData && $cityData->country ? $cityData->country->name : null;
        
        // Fetch flights for the selected city
        $flightsQuery = DepartureFlights::whereHas('package.destination', function ($query) use ($depCityId) {
            $query->where('id', $depCityId);
        })->with(['package' => function ($query) {
            $query->select('id', 'price'); 
        }]);
        
        if ($selectedMonth && strtolower($selectedMonth) !== 'all') {
            $monthNumber = date('m', strtotime($selectedMonth));            $flightsQuery->whereMonth('departure_date', $monthNumber);
            $flightsQuery->whereMonth('return_date', $monthNumber);
        }
        
        if ($category) {
            $flightsQuery->where('category', $category);
        }

        $flights = $flightsQuery->get();
        
        // Group flights by year and month
        $data = [];
        foreach ($flights as $flight) {
            if (!empty($flight->departure_date)) {
                $year = Carbon::parse($flight->departure_date)->format('Y');
                $month = Carbon::parse($flight->departure_date)->format('F');
                $data[$year][$month][] = $flight;
            }
        }
    
        // Format the data
        $formattedData = [];
        foreach ($data as $year => $months) {
            foreach ($months as $month => $flights) {
                $formattedData[] = [
                    'year' => $year,
                    'month' => $month,
                    'flights' => $flights,
                ];
            }
        }
    
        return response()->json([
            'success' => true,
            'cityName' => $countryName,
            'data' => $formattedData,
        ]);
    }

    public function getDepartureFlightDates(Request $request){
        $depCityId = $request->DEPC;
        
        $flights = DepartureFlights::whereHas('package.destination', function ($query) use ($depCityId) {
            $query->where('id', $depCityId);
        })
        ->orderBy('departure_date', 'asc')
        ->get();
    
        // Format dates with sold-out status
        $dateList = [];
        foreach ($flights as $flight) {
            $dateList[] = [
                'date' => Carbon::parse($flight->departure_date)->format('Y-m-d'),
                'status' => $flight->status,
            ];
        }
    
        // Return response with the date listing
        return response()->json([
            'success' => true,
            'dates' => $dateList,
        ]);
    } 
}
