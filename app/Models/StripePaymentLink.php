<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StripePaymentLink extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'stripe_id',
        'stripe_object',
        'stripe_active',
        'stripe_allow_promotion',
        'stripe_redirect_url',
        'stripe_currency',
        'stripe_url',
        'stripe_submit_type',
        'payment_method_types'
    ];
}
