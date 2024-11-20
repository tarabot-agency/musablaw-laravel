<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partener;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class PartenerController extends Controller
{
    use GeneralTrait;
    public function index(Request $request)
    {
        try {
            $parteners = Partener::orderBy('id', 'DESC')->paginate(15);
            return view('Admin.Partener.index', compact('parteners'));
        } catch (\Exception $e) {
            return view('general-error');
        }
    }

    public function create()
    {
        try {
            return view('Admin.Partener.create');
        } catch (\Exception $e) {
            return view('general-error');
        }
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'image' => 'required|mimes:png,jpg,jpeg',
            ]);
            if ($validator->fails()) {
                Session::flash('message',  $validator->errors()->first());
                Session::flash('alert-class', 'alert-danger');
                return redirect()->back()->withInput();
            }
            $partener = new Partener();
            $partener->name = $request->name;
            $photo = $this->saveImage($request->image, 'parteners');
            $partener->image = $photo;
            $partener->save();
            Session::flash('message', __('app.partener') . ' ' . __('app.added_successfully'));
            Session::flash('alert-class', 'alert-success');
            DB::commit();
            return redirect()->route('parteners.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return view('general-error');
        }
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $partener = Partener::findOrFail($id);
            if (!$partener) {
                Session::flash('message', __('app.partener') . ' ' . __('app.is_not_exist'));
                Session::flash('alert-class', 'alert-danger');
                return redirect()->route('parteners.index');
            }
            $filePath = public_path('images/parteners/' . $partener->image);
            if (File::exists($filePath)) {
                File::delete($filePath);
            }
            $partener->delete();
            Session::flash('message', __('app.partener') . ' ' . __('app.deleted_successfully'));
            Session::flash('alert-class', 'alert-success');
            DB::commit();
            return redirect()->route('parteners.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return view('general-error');
        }
    }
}
