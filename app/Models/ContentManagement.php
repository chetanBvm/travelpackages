<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContentManagement extends Model
{
    use SoftDeletes;
    protected $fillable = ['title', 'subtitle', 'content', 'header_title', 'type', 'keywords','image','description','icon','header_content'];
}
