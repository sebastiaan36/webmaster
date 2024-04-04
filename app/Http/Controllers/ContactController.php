<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function SendMail(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        $data = array(
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message
        );

        Mail::send('mail.contact', $data, function($message) use ($data){
            $message->from('info@been-vandam.nl');
            $message->to('info@been-vandam.nl');
            $message->subject('Contactformulier');
            $message->replyTo($data['email']);


    });
    return redirect('/#contact')->with('success', 'Your email has been sent');
        }
}
