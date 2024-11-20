<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    use GeneralTrait;
    public function index(Request $request)
    {
        try {
            $admins = Admin::whereNot('id', 1)->orderBy('id', 'DESC');
            if (isset($request->search)) {
                $admins = $admins->where(function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->search . '%')
                        ->orWhere('email', 'like', '%' . $request->search . '%')
                        ->orWhere('phone', 'like', '%' . $request->search . '%');
                });
            }
            $admins = $admins->paginate(15);
            return view('Admin.Admin.index', compact('admins'));
        } catch (\Exception $e) {
            return view('general-error');
        }
    }

    public function show($id)
    {
        try {
            $admin = Admin::findOrFail($id);
            return view('Admin.Admin.show', compact('admin'));
        } catch (\Exception $e) {
            return view('general-error');
        }
    }

    public function create()
    {
        try {
            return view('Admin.Admin.create');
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
                'email' => 'required|email|unique:admins,email',
                'phone' => 'required|unique:admins,phone',
                'password' => 'required|min:5',
                'confirm_password' => 'required|min:5|same:password',
                'photo' => 'mimes:jpg,jpeg,bmp,png,jpeg,svg',
            ]);
            if ($validator->fails()) {
                Session::flash('message',  $validator->errors()->first());
                Session::flash('alert-class', 'alert-danger');
                return redirect()->back()->withInput();
            }
            $admin = new Admin();
            $admin->name = $request->name;
            $admin->email = $request->email;
            $admin->phone = $request->phone;
            $password = bcrypt($request->password);
            $admin->password = $password;
            if ($request->hasFile('photo')) {
                $photo = $this->saveImage($request->photo, 'admins');
                $admin->image = $photo;
            }
            $admin->save();
            Session::flash('message', __('app.admin') . ' ' . __('app.added_successfully'));
            Session::flash('alert-class', 'alert-success');
            DB::commit();
            return redirect()->route('admins.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return view('general-error');
        }
    }

    public function edit($id)
    {
        try {
            $admin = Admin::findOrFail($id);
            if (!$admin) {
                Session::flash('message', __('app.admin') . '' .  __('app.is_not_exist'));
                Session::flash('alert-class', 'alert-danger');
                return redirect()->route('admins.index');
            }
            return view('Admin.Admin.edit', compact('admin'));
        } catch (\Exception $e) {
            return view('general-error');
        }
    }

    public function update($id, Request $request)
    {
        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required',
            ]);
            if ($validator->fails()) {
                Session::flash('message',  $validator->errors()->first());
                Session::flash('alert-class', 'alert-danger');
                return redirect()->back()->withInput();
            }
            $check_email = Admin::where('email', $request->email)->where('id', '!=', $id)->first();
            if ($check_email) {
                Session::flash('message',  __('app.email_used_before'));
                Session::flash('alert-class', 'alert-danger');
                return redirect()->back()->withInput();
            }

            $check_phone = Admin::where('phone', $request->phone)->where('id', '!=', $id)->first();
            if ($check_phone) {
                Session::flash('message',  __('app.phone_used_before'));
                Session::flash('alert-class', 'alert-danger');
                return redirect()->back()->withInput();
            }
            $admin = Admin::findOrFail($id);
            if (!$admin) {
                Session::flash('message', __('app.admin') . ' ' . __('app.is_not_exist'));
                Session::flash('alert-class', 'alert-danger');
                return redirect()->back()->withInput();;
            }
            $admin->name = $request->name;
            $admin->email = $request->email;
            $admin->phone = $request->phone;
            if ($request->has('password') && $request->password != '' && $request->password != null) {
                $password = bcrypt($request->password);
                $admin->password = $password;
            }
            if ($request->hasFile('photo')) {
                $photo = $this->saveImage($request->photo, 'admins');
                $admin->image = $photo;
            }
            $admin->save();
            Session::flash('message', __('app.admin') . ' ' . __('app.updated_successfully'));
            Session::flash('alert-class', 'alert-success');
            DB::commit();
            return redirect()->route('admins.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return view('general-error');
        }
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $admin = Admin::findOrFail($id);
            if (!$admin) {
                Session::flash('message', __('app.admin') . ' ' . __('app.is_not_exist'));
                Session::flash('alert-class', 'alert-danger');
                return redirect()->route('admins.index');
            }
            $filePath = public_path('images/admins/' . $admin->image);
            if (File::exists($filePath)) {
                File::delete($filePath);
            }
            $admin->delete();
            Session::flash('message', __('app.admin') . ' ' . __('app.deleted_successfully'));
            Session::flash('alert-class', 'alert-success');
            DB::commit();
            return redirect()->route('admins.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return view('general-error');
        }
    }
}
