<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable =['c_formName','c_currency','departure_date','departure_city','passengers_adult','passengers_children','passengers_infant','room_occupancy','passenger_name','phone','c_email','signup','package_id','package_name','special_requests','transaction_id','status','reject_reason'];

    public function airport(){
        return $this->hasOne(Airport::class,'id','departure_city');
    } 
}
