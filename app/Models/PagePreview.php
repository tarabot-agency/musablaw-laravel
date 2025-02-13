<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PagePreview extends Model
{
    protected $fillable = [
        "title",
        "description",
        "image",
    ];

    public function secondaryImages()
    {
        return $this->hasMany(PageSecondaryImage::class);
    }
}
