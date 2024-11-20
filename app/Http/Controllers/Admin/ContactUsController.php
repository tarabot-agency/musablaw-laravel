<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ContactUsController extends Controller
{
    public function index(Request $request)
    {
        try {
            $contact_uss = ContactUs::orderBy('id', 'DESC')->paginate(15);
            return view('Admin.ContactUs.index', compact('contact_uss'));
        } catch (\Exception $e) {
            return view('general-error');
        }
    }

    public function show($id)
    {
        try {
            $contact = ContactUs::findOrFail($id);
            return view('Admin.ContactUs.show', compact('contact'));
        } catch (\Exception $e) {
            return view('general-error');
        }
    }
    public function delete($id)
    {
        try {
            $contact = ContactUs::findOrFail($id);
            if (!$contact) {
                Session::flash('message', __('app.contact_us') . ' ' . __('app.is_not_exist'));
                Session::flash('alert-class', 'alert-danger');
                return redirect()->route('projects.index');
            }
            $contact->delete();
            Session::flash('message', __('app.contact_us') . ' ' . __('app.deleted_successfully'));
            Session::flash('alert-class', 'alert-success');
            return redirect()->route('contact-us.index');
        } catch (\Exception $e) {
            return view('general-error');
        }
    }
}
