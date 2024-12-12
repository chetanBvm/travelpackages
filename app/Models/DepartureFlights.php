<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DepartureFlights extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable= ['package_id','departure_date','return_date','year','price','status'];

    public function package(){
        return $this->belongsTo(Package::class);
    }
}
