<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Stripe\PaymentLink;
use Stripe\Stripe;

class StripePaymentController extends Controller
{

    public function createPaymentLink(Package $package)
    {

        try {
            $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

            $prices = $stripe->prices->create([
                'currency' => strtolower($package->destination->country->currency),
                'unit_amount' => floor($package->price),
                'product_data' => ['name' => $package->name],
              ]);
                        
            $paymentLink = $stripe->paymentLinks->create([
                'line_items' => [
                    [
                        'price' => $prices->id,
                        'quantity' => 1,
                    ],
                ],
            ]);

            // Get the URL
            $paymentLinkUrl = $paymentLink->url;

            return  $paymentLinkUrl;

        } catch (\Exception $e) {
            Log::error('Stripe API Error: ' . $e->getMessage());
            return response()->json(['error', 'Something error' . $e->getMessage()], 500);
        }
    }
}
