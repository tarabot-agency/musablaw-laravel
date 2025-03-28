<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Setting;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

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
            // $settings['our_services'] = Page::select(
            //     'id',
            //     'title_en as title',
            // )
            //     ->where('section', 'our_services')
            //     ->take(3)
            //     ->get();
            return $this->returnData('settings', $settings);
        } catch (\Exception $e) {
            return $this->returnError($e->getCode(), $e->getMessage());
        }
    }
}
