<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class ExperienceController extends Controller
{
    use GeneralTrait;
    public function index(Request $request)
    {
        try {
            $experiences = Experience::orderBy('id', 'DESC')->paginate(15);
            return view('Admin.Experience.index', compact('experiences'));
        } catch (\Exception $e) {
            return view('general-error');
        }
    }

    public function create()
    {
        try {
            return view('Admin.Experience.create');
        } catch (\Exception $e) {
            return view('general-error');
        }
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            // $validator = Validator::make($request->all(), [
            //     'name' => 'required',
            //     'image' => 'required|mimes:png,jpg,jpeg',
            // ]);
            // if ($validator->fails()) {
            //     Session::flash('message',  $validator->errors()->first());
            //     Session::flash('alert-class', 'alert-danger');
            //     return redirect()->back()->withInput();
            // }
            $experience = new Experience();
            $experience->name = $request->name;
            $photo = null;
            if($request->hasFile('image')){
                $photo = $this->saveImage($request->image, 'experiences');
            }
            $experience->image = $photo;
            $experience->save();
            Session::flash('message', __('app.experience') . ' ' . __('app.added_successfully'));
            Session::flash('alert-class', 'alert-success');
            DB::commit();
            return redirect()->route('experiences.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return view('general-error');
        }
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $experience = Experience::findOrFail($id);
            if (!$experience) {
                Session::flash('message', __('app.experience') . ' ' . __('app.is_not_exist'));
                Session::flash('alert-class', 'alert-danger');
                return redirect()->route('experiences.index');
            }
            $filePath = public_path('images/experiences/' . $experience->image);
            if (File::exists($filePath)) {
                File::delete($filePath);
            }
            $experience->delete();
            Session::flash('message', __('app.experience') . ' ' . __('app.deleted_successfully'));
            Session::flash('alert-class', 'alert-success');
            DB::commit();
            return redirect()->route('experiences.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return view('general-error');
        }
    }
}
