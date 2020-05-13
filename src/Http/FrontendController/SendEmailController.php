<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class SendEmailController extends Controller
{
	public function contactUs(){

	}

    public function sendEmail(Request $request){
    	
	$this->validate($request,[
        'name' 		=> 'required',
        'email' 	=> 'required|email',
        'subject' 	=> 'required',
        'phone' 	=> 'required',
        'message' 	=> 'required',
    ]);

	$name 		= $request->name;
	$email 		= $request->email;
	$phone 		= $request->phone;
	$message 	= $request->message;
	$subject 	= $request->subject;

	$formcontent="From: $name \n Phone: $phone \n Message: $message";
	$recipient = env('Email_Sender');
	$mailheader = "From: $email \r\n";
	
	mail($recipient, $subject, $formcontent, $mailheader) or die("Error!");
		
	alert()->success('We will call you back!', 'Sending email successfully')->persistent('Close');

	return Redirect::to('/contact-us');
    }

}
