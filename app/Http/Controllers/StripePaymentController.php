<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Package;
use App\Models\Price as ModelsPrice;
use App\Models\StripePaymentIntent;
use App\Models\StripePaymentLink;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Stripe\PaymentLink;
use Stripe\Price;
use Stripe\Refund;
use Stripe\Stripe;

class StripePaymentController extends Controller
{

    public function createPaymentLink(Package $package,Booking $bookings)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            $price = Price::create([
                'unit_amount' => floor($package->price),
                'currency' => strtolower($package->destination->country->currency),
                'product_data' => [
                    'name' => $package->name,
                ],
            ]);
            Log::info('price', [$price]);
            
            ModelsPrice::create([
               'stripe_id' =>$price->id,
               'stripe_object' => $price->object,
               'stripe_created' => $price->created,
               'stripe_currency' =>$price->currency,
               'stripe_product' => $price->product,
               'stripe_unit_amount' => $price->unit_amount,
               'stripe_unit_amount_decimal' =>  $price->unit_amount_decimal,
               'stripe_type' => $price->type,    
            ]);
            $paymentLink = PaymentLink::create([
                // 'payment_method_types' => ['card'],
                'line_items' => [
                    [
                        'price' => $price->id,
                        'quantity' => 1,
                    ],
                ],
                'after_completion' => [
                    'type' => 'redirect',
                    'redirect' => ['url' => route('dashboard')],
                ],
            ]);
            StripePaymentLink::create([
                'booking_id' => $bookings->id,
                'stripe_id' => $paymentLink->id,
                'stripe_object' => $paymentLink->object,
                'stripe_active'=> $paymentLink->active,
                'stripe_redirect_url' => $paymentLink->after_completion->redirect->url,
                'stripe_allow_promotion' => $paymentLink->allow_promotion_codes,
                'stripe_currency' => $paymentLink->currency,
                'stripe_url' => $paymentLink->url,
                'stripe_submit_type' => $paymentLink->submit_type,
                'payment_method_types' => $paymentLink->payment_method_types
            ]);            
            return $paymentLink->url;
        
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function handleWebhook(Request $request)
    {
        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');
        $endpointSecret = config('services.stripe.websecret');
        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload,
                $sigHeader,
                $endpointSecret
            );

            if ($event->type === 'payment_intent.succeeded') {
                $payment = $event->data;
                Log::info($payment);
                StripePaymentIntent::updateOrCreate(['stripe_payment_id' => $payment->object->id],[
                    'stripe_created'=> $payment->object->created,
                    'stripe_amount' => $payment->object->amount,
                    'amount_received' => $payment->object->amount_received,
                    'capture_method' => $payment->object->capture_method,
                    'client_secret' => $payment->object->client_secret,
                    'confirmation_method' => $payment->object->confirmation_method,
                    'currency' => $payment->object->currency,
                    'latest_charge' => $payment->object->latest_charge,
                    'payment_method' => $payment->object->payment_method,
                    'payment_method_types' => $payment->object->payment_method_types,
                    'status' => $payment->object->status,
                    'request_id' => $event->request->id,
                    'idempotency_key' => $event->request->idempotency_key,
                    'type' => $event->type,
                ]);
            }

            return response('Webhook handled', 200);
        } catch (\UnexpectedValueException $e) {
            Log::info('error unexpected value exception',$e->getMessage());
            return response('Invalid payload', 400);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            Log::info('error signature verification',$e->getMessage());
            return response('Invalid signature', 400);
        }
    }

    public function refundPayment(Request $request) {
        //set the stripe key
        Stripe::setApiKey(config('services.stripe.secret'));

        $paymentIntentId = $request->input('payment_intent');
        
        try{
            $refund = Refund::create([
                'payment_intent' => $paymentIntentId,
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Payment refunded successfully',
                'data' => $refund,
            ]);
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }
}
