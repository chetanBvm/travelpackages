<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PackageReview extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['package_id','name','description','images','status'];


    public function package(){
        return $this->hasOne(Package::class,'id','package_id');
    }
}
