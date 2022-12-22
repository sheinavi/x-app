<?php

namespace App\Http\Controllers;

use App\Mail\ContactUsEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MessagesController extends Controller
{
    public function store(Request $request){

        $this->validate($request, [            
            'email' => 'required|regex:/(.+)@(.+)\.(.+)/i|email:rfc,dns',
            'message' => 'required'
          ]);

        foreach (['sheinavi@gmail.com', $request->email] as $recipient) {
            Mail::to($recipient)->send(new ContactUsEmail($request->message));
        }

        return back();
    }
}