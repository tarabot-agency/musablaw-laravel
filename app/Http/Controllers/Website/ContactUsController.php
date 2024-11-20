<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Mail\ContactUsEmail;
use App\Models\ContactUs;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ContactUsController extends Controller
{
    use GeneralTrait;
    public function send(Request $request)
    {
        try {
            $validator = validator()->make($request->all(), [
                'name' => 'required',
                'email' => 'required|email',
                'phone' => 'required',
                'message' => 'required',
            ]);
            if ($validator->fails()) {
                return $this->returnError('001', $validator->errors()->first());
            }
            DB::beginTransaction();
            $contactUsEmail = new ContactUs();
            $contactUsEmail->name = $request->name;
            $contactUsEmail->email = $request->email;
            $contactUsEmail->phone = $request->phone;
            $contactUsEmail->message = $request->message;
            $contactUsEmail->save();
            // Mail::to(Setting('contact_us_email'))
            //     ->send(new ContactUsEmail($request->all()));
            DB::commit();
            return $this->returnSuccessMessage('تم ارسال الرسالة بنجاح');
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->returnError($e->getCode(), $e->getMessage());
        }
    }
}
