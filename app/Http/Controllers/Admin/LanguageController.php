<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LanguageController extends Controller
{
    public function switchLang($lang)
    {
        session(['language' => $lang]);
        return redirect()->back()->with(['language_switched' => $lang]);
    }
}
