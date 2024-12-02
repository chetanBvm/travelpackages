<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PackageImages extends Model
{
    protected $fillable = ['package_id', 'images'];

    public function package(): HasOne
    {
        return $this->hasOne(Package::class, 'id', 'package_id');
    }
}
