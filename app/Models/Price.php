<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;

   protected $fillable = [
    'stripe_id','stripe_object','stripe_created','stripe_currency','stripe_product','stripe_unit_amount','stripe_unit_amount_decimal','stripe_type'
   ];
}
