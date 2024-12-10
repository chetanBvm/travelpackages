<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exclusions extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['package_id', 'name', 'status', 'type', 'status', 'description'];

    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }
}
