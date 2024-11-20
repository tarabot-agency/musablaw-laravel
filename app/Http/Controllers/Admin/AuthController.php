<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function create()
    {
        try {
            return view('Admin.Auth.create');
        } catch (\Exception $e) {
            return view('general-error');
        }
    }
    public function loginPage()
    {
        return view('Admin.Auth.login');
    }

    public function loginAdmin(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|exists:admins,email',
                'password' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $credentials = ['email' => $request->email, 'password' => $request->password];

            if (Auth::guard('admin')->attempt($credentials)) {
                return redirect()->route('admin.dashboard');
            }
            return view('Admin.Auth.login');
        } catch (\Exception $e) {
            return view('Admin.Auth.login');
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        return redirect()->route('/');
    }
}
