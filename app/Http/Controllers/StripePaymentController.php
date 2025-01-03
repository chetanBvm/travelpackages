<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Stripe\PaymentLink;
use Stripe\Price;
use Stripe\Stripe;

class StripePaymentController extends Controller
{

    public function createPaymentLink(Package $package)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $price = Price::create([
            'unit_amount' => floor($package->price),
            'currency' => strtolower($package->destination->country->currency),
            'product_data' => [
                'name' => $package->name,
            ],
        ]);
        Log::info('price',[$price]);
        $paymentLink = PaymentLink::create([
            // 'payment_method_types' => ['card'],
            'line_items' => [
                [
                    'price' => $price->id, // Replace with your actual price ID
                    'quantity' => 1,
                ],
            ],
            'after_completion' => [
                'type' => 'redirect',
                'redirect' => ['url' => route('dashboard')],
            ],
        ]);
            
        return $paymentLink->url;
    }
 
    public function handleWebhook(Request $request)
    {
        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');
        $endpointSecret = config('services.stripe.secret');
    
        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload,
                $sigHeader,
                $endpointSecret
            );
    
            if ($event->type === 'payment_intent.succeeded') {
                Log::info('event'.$event);
            }
    
            return response('Webhook handled', 200);
        } catch (\UnexpectedValueException $e) {
            return response('Invalid payload', 400);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            return response('Invalid signature', 400);
        }
    }
}
