<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageSecondaryImage extends Model
{
    protected $fillable = [
        "page_id",
        "image"
    ];
}
