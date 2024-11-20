<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class OurServicesController extends Controller
{
    use GeneralTrait;
    public function index(Request $request)
    {
        try {
            $services = Page::where('section', 'our_services')
                ->orderBy('id', 'DESC')
                ->paginate(15);
            return view('Admin.OurServices.index', compact('services'));
        } catch (\Exception $e) {
            return view('general-error');
        }
    }

    public function create()
    {
        try {
            return view('Admin.OurServices.create');
        } catch (\Exception $e) {
            return view('general-error');
        }
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $website_lang = Setting('website_language');
            $page_key = '';
            if ($website_lang == 'ar') {
                $validator = Validator::make($request->all(), [
                    'title_ar' => 'required',
                    'description_ar' => 'required',
                ]);
                $page_key = rand(100000, 999999);
            } elseif ($website_lang == 'en') {
                $validator = Validator::make($request->all(), [
                    'title_en' => 'required',
                    'description_en' => 'required',
                ]);
                $page_key = create_page_key($request->title_en);
            } else {
                $validator = Validator::make($request->all(), [
                    'title_ar' => 'required',
                    'title_en' => 'required',
                    'description_ar' => 'required',
                    'description_en' => 'required',
                ]);
                $page_key = create_page_key($request->title_en);
            }
            if ($validator->fails()) {
                Session::flash('message',  $validator->errors()->first());
                Session::flash('alert-class', 'alert-danger');
                return redirect()->back()->withInput();
            }
            $service = Page::where('key', $page_key)->first();
            if ($service) {
                Session::flash('message',  'This service is already exist');
                Session::flash('alert-class', 'alert-danger');
                return redirect()->back();
            }
            $service = new Page();
            $service->section = 'our_services';
            $service->key = $page_key;
            $service->title_en = $request->title_en;
            $service->title_ar = $request->title_ar;
            $service->description_en = $request->description_en;
            $service->description_ar = $request->description_ar;
            $service->icon = $request->icon;
            if ($request->hasFile('image')) {
                $image = $this->saveImage($request->image, 'pages');
                $service->image = $image;
            }
            $service->save();
            if (isset($request->supSections)) {
                foreach ($request->supSections as $sub_section) {
                    $service->subPages()->create([
                        'content_en' => $sub_section['content_en'] ?? null,
                        'content_ar' => $sub_section['content_ar'] ?? null
                    ]);
                }
            }
            Session::flash('message', __('app.service') . ' ' . __('app.added_successfully'));
            Session::flash('alert-class', 'alert-success');
            DB::commit();
            return redirect()->route('our-services.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return view('general-error');
        }
    }

    public function delete($key)
    {
        try {
            DB::beginTransaction();
            $service = Page::where('section', 'our_services')
                ->where('key', $key)
                ->first();
            if (!$service) {
                Session::flash('message', __('app.service') . '' .  __('app.is_not_exist'));
                Session::flash('alert-class', 'alert-danger');
                return redirect()->route('our-services.index');
            }
            $filePath = public_path('images/pages/' . $service->image);
            if (File::exists($filePath)) {
                File::delete($filePath);
            }
            $service->subPages()->delete();
            $service->delete();
            Session::flash('message', __('app.service') . ' ' . __('app.deleted_successfully'));
            Session::flash('alert-class', 'alert-success');
            DB::commit();
            return redirect()->route('our-services.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return view('general-error');
        }
    }
}
