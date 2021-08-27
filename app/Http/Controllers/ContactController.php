<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function index()
    {
        $data['setting'] = Setting::select('email', 'phone')->first();
        return view('web.contact.index')->with($data);
    }

    public function send(Request $request)
    {
        $request->validate([ //$validator = Validator::make($request->all(),
            'name' => 'required|string|max:255',
            'email' => 'required|email|string|max:255',
            'subject' => 'nullable|string|max:255',
            'body' => 'required|string',
        ]);

        // if ($validator->fails()) {
        //     $errors = $validator->errors();
        //     return Response::json($errors); //redirect(url('contact'))->withErrors($errors)
        // }

        Message::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'body' => $request->body,
        ]);

        // $request->session()->put('success', 'your message sent successfully');
        // return back();
        $data = [
            'success' => 'your message sent successfully'
        ];

        return Response::json($data);
    }
}