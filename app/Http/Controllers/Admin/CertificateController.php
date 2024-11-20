<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CertificateController extends Controller
{
    use GeneralTrait;
    public function index(Request $request)
    {
        try {
            $certificates = Certificate::orderBy('id', 'DESC')->paginate(15);
            return view('Admin.Certificate.index', compact('certificates'));
        } catch (\Exception $e) {
            return view('general-error');
        }
    }

    public function create()
    {
        try {
            return view('Admin.Certificate.create');
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
            $certificate = new Certificate();
            $certificate->name = $request->name;
            $photo = $this->saveImage($request->image, 'certificates');
            $certificate->image = $photo;
            $certificate->save();
            Session::flash('message', __('app.certificate') . ' ' . __('app.added_successfully'));
            Session::flash('alert-class', 'alert-success');
            DB::commit();
            return redirect()->route('certificates.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return view('general-error');
        }
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $certificate = Certificate::findOrFail($id);
            if (!$certificate) {
                Session::flash('message', __('app.certificate') . ' ' . __('app.is_not_exist'));
                Session::flash('alert-class', 'alert-danger');
                return redirect()->route('certificates.index');
            }
            $filePath = public_path('images/certificates/' . $certificate->image);
            if (File::exists($filePath)) {
                File::delete($filePath);
            }
            $certificate->delete();
            Session::flash('message', __('app.certificate') . ' ' . __('app.deleted_successfully'));
            Session::flash('alert-class', 'alert-success');
            DB::commit();
            return redirect()->route('certificates.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return view('general-error');
        }
    }
}
