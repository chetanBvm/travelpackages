<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'description', 'price', 'days', 'images','status','destination_id','sub_title'];

    public function destination(): HasOne
    {
        return $this->hasOne(Destination::class,'id','destination_id');
    }

    public function images()
    {
        return $this->hasMany(PackageImages::class);  
    }
}
