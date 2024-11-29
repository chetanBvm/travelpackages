<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inclusions extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['package_id','status','type','status','description'];

    public function package(){
        return $this->hasOne(Package::class,'id','package_id');
    }
}
