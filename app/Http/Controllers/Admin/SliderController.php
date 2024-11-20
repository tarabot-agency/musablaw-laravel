<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class SliderController extends Controller
{
    use GeneralTrait;
    public function index(Request $request)
    {
        try {
            $sliders = Slider::orderBy('id', 'DESC')->paginate(15);
            return view('Admin.Slider.index', compact('sliders'));
        } catch (\Exception $e) {
            return view('general-error');
        }
    }

    public function create()
    {
        try {
            return view('Admin.Slider.create');
        } catch (\Exception $e) {
            return view('general-error');
        }
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'image_en' => 'required|mimes:png,jpg,jpeg',
                'image_ar' => 'required|mimes:png,jpg,jpeg',
            ]);
            if ($validator->fails()) {
                Session::flash('message',  $validator->errors()->first());
                Session::flash('alert-class', 'alert-danger');
                return redirect()->back()->withInput();
            }
            $slider = new Slider();
            $image_en = $this->saveImage($request->image_en, 'sliders');
            $image_ar = $this->saveImage($request->image_ar, 'sliders');
            $slider->image_en = $image_en;
            $slider->image_ar = $image_ar;
            $slider->save();
            Session::flash('message', __('app.slider') . ' ' . __('app.added_successfully'));
            Session::flash('alert-class', 'alert-success');
            DB::commit();
            return redirect()->route('sliders.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return view('general-error');
        }
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $slider = Slider::findOrFail($id);
            if (!$slider) {
                Session::flash('message', __('app.slider') . ' ' . __('app.is_not_exist'));
                Session::flash('alert-class', 'alert-danger');
                return redirect()->route('sliders.index');
            }
            $filePath = public_path('images/sliders/' . $slider->image);
            if (File::exists($filePath)) {
                File::delete($filePath);
            }
            $slider->delete();
            Session::flash('message', __('app.slider') . ' ' . __('app.deleted_successfully'));
            Session::flash('alert-class', 'alert-success');
            DB::commit();
            return redirect()->route('sliders.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return view('general-error');
        }
    }
}
