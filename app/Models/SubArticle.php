<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubArticle extends Model
{
    protected $fillable = [
        'article_id',
        'title',
        'sub_title',
        'description_ar',
        'image',
    ];
}
