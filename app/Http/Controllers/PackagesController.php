<?php

namespace App\Http\Controllers;

use App\Models\Airport;
use App\Models\Banner;
use App\Models\Country;
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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PackagesController extends Controller
{
    public function tourPackages()
    {
        $data['package'] = Package::with('destination.country')->paginate(20);
        $data['banner'] = Banner::where('type','Packages')->first();
        $data['country'] = Country::get();
        $data['packageType'] = PackageType::get();
        return view('web.packages.tourpackages', compact('data'))->with('filteredPackages', collect());
    }
    /**
     * @return  int $id 
     * use for the getting package detail data 
     */
    public function packageDetail(int $id)
    {
        $packages = Package::with('images')->findOrFail($id);
        $data['packageImages'] = PackageImages::where('package_id',$id)->get();
        $data['packages'] = Package::get()->take(3);
        $data['feature'] = Package::get()->take(10);
        $data['itinerary'] = Itinerary::where('package_id',$id)->first();
        $data['airport'] = Airport::get();
        $data['country'] = Country::get();
        $data['coupon'] = Promotion::get();
        $data['review'] = PackageReview::where('package_id',$id)->get();
        $data['inclusion'] = Inclusions::where('package_id',$id)->where('status' , 'Active')->first();
        $data['exclusion'] = Exclusions::where('package_id',$id)->where('status' , 'Active')->first();
        $data['destination'] = Destination::with('country')->get();
        $data['departureFlight'] = DepartureFlights::with('package.destination')->get();
        
        return view('web.packages.packagedetail',compact('packages','data'));
    }

    /**
     * Downlaod the pdf for the accomendation or inclusion
     */
    public function downloadPdf($id){
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

    public function getDepartureFlight(Request $request){
        $flights = DepartureFlights::whereHas('package.destination', function ($query) use ($request) {
            $query->where('id', $request->DEPC);
        })
        ->select([
            DB::raw('YEAR(departure_date) as year'),
            DB::raw('MONTH(departure_date) as month'),
            'departure_date',
            'return_date',
            'price',
            'status',
        ])
        ->with('package.destination')
        ->get()
        ->groupBy('year'); 

        $data = $flights->map(function ($items, $year) {
            return [
                'year' => $year,
                'flights' => $items->map(function ($item) {
                    return [
                        'month' => $item->month,
                        'departure_date' => $item->departure_date,
                        'return_date' => $item->return_date,
                        'price' => $item->price,
                        'status' => $item->status,
                    ];
                }),
            ];
        });


        return response()->json(['success' => true,'data' => $data]);
    }
}
