<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Destination extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [ 'countries_id','name', 'type', 'status','image'];

    public function country(){
        return $this->hasOne(Country::class,'id','countries_id');
    }
}
