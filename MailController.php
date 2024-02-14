<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

class MailController extends Controller
{
    function sendmail(Request $request)
   {
        if($request->email){
            $request->validate([
                'name' => 'required|min:2|max:200',
                'message' => 'required|min:10|max:1000',
                'email' => 'email',
                'captcha' => 'required|captcha',
                'wynik' => 'in: 4'
            ]);
        } else {
            $request->validate([
                'name' => 'required|min:2|max:200',
                'message' => 'required|min:10|max:1000',
                'captcha' => 'required|captcha',
                'wynik' => 'in: 4'
            ]);
        }
        if($request->email) {
            $data = array(
                'name' => $request->name,
                'message' => $request->message,
                'email' => $request->email,
            );
        } else {
            $data = array(
                'name' => $request->name,
                'message' => $request->message,
            );
        }
        try {
            Mail::to('dariusz.trawicki@piekarnia-el.pl')->send(new SendMail($data));
            return back()->with('email_succes', true);
        } catch (Exception $e) {
            return back()->with('email_succes', false);
        }
    }

    public function reloadCaptcha()
    {
        return response()->json(['captcha'=> captcha_img()]);
    }
}
