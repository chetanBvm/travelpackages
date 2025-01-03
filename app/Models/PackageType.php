<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PackageType extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['name','parent_id'];

    public function subpackage()
    {
        return $this->hasMany(PackageType::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(PackageType::class, 'parent_id');
    }
}
