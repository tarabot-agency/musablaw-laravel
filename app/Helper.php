<?php

use App\Models\Setting;

function Setting($key)
{
    $setting = Setting::where('key', $key)->first();
    if (!$setting) {
        return false;
    }
    return $setting->value;
}

function create_page_key($title)
{
    return str_replace(' ', '_', strtolower($title));
}
