<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    use GeneralTrait;
    public function show()
    {
        try {
            $settings = Setting::all();
            return view('Admin.Setting.show', compact('settings'));
        } catch (\Exception $e) {
            return view('general-error');
        }
    }

    public function update(Request $request)
    {
        try {
            $settings_key = Setting::whereNot('unit', 'file')->pluck('key');
            $keys = [];
            $keys = array_fill_keys($settings_key->all(), 'required');
            $validator = Validator::make($request->all(), $keys);
            if ($validator->fails()) {
                Session::flash('message',  $validator->errors()->first());
                Session::flash('alert-class', 'alert-danger');
                return redirect()->back()->withInput();
            }
            $settings = Setting::all();
            foreach ($settings as $setting) {
                $value = $request->input($setting->key);
                if ($setting->unit == 'file' && $request->hasFile($setting->key)) {
                    $value = $this->saveImage($request->file($setting->key), 'settings');
                }
                if ($value) {
                    $setting->update([
                        'value' => $value
                    ]);
                }
            }
            Session::flash('message', __('app.general_settings') . ' ' . __('app.updated_successfully'));
            Session::flash('alert-class', 'alert-success');
            return redirect()->back()->with('success');
        } catch (\Exception $e) {
            return view('general-error');
        }
    }
}
