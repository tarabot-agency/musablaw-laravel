<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Traits\GeneralTrait;

class GeneralSettingController extends Controller
{
    use GeneralTrait;

    public function baseConfigurations()
    {
        try {
            $settings = Setting::get()
                ->map(function ($setting) {
                    $value = $setting->value;
                    if ($setting->unit == 'file') {
                        $value = asset('images/settings/' . $value);
                    }
                    return [
                        "id" => $setting->id,
                        "key" => $setting->key,
                        "value" => $value,
                    ];
                });
            return $this->returnData('settings', $settings);
        } catch (\Exception $e) {
            return $this->returnError($e->getCode(), $e->getMessage());
        }
    }
}
