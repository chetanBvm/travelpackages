<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StripePaymentIntent extends Model
{
    use HasFactory;

    protected $fillable = [
        'stripe_payment_id',
        'stripe_created',
        'stripe_amount',
        'amount_received',
        'capture_method',
        'client_secret',
        'confirmation_method',
        'currency',
        'payment_method',
        'latest_charge',
        'payment_method_types',
        'request_id',
        'idempotency_key',
        'type',
        'status'
    ];

    protected $casts = [
        'payment_method_types' => 'array',
    ];
}
