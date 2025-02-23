<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        "section",
        "key",
        "title_en",
        "title_ar",
        "description_en",
        "description_ar",
        "image",
        "icon",
        "slug",
        "show_at",
        "meta_description",
        "meta_title"
    ];

    public function subPages()
    {
        return $this->hasMany(SubPage::class);
    }

    public function secondaryImages()
    {
        return $this->hasMany(PageSecondaryImage::class);
    }
}
