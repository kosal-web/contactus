<?php

namespace Din\ContactUs\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

class ContactUsController extends Controller
{
    public function index(Request $request) {
    	$data = $request->all();
dd('ok');
		$validate = [
			"name"  => "required",
			// "phone"  => "required",
			// "first_name"  => "required",
			"email" => "required|email",
			// "dob"  => "required",
			// "nationality"  => "required",
			// "cruising_date"  => "required",
			// "cruise"  => "required",
			// "num_passenger"  => "required",
			// "pass_info"  => "required",
			// "add_info"  => "required"
		];

		$validator = Validator::make($data , $validate);
		$redirect_url = url('contact-us');
		if($validator->fails()){

			return redirect($redirect_url)->withErrors($validator)->withInput();
		}
		
		$view = 'IT Testing';
		$subject = 'IT Testing Sending Email';

		\Mail::raw($view, function ($message) use ($request, $subject)
        {
            $message->subject($subject, $request->name);
            $message->from($request->email);
            $message->to('kosalkanit@gmail.com');
        });

		return redirect($redirect_url)->with('message', 'Your message has been sent successfully!');
    }
}