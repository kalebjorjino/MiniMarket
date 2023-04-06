<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Mail\ContactUsMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class StorefrontController extends Controller
{
    //
    public function index() {
        return view('welcome');
    }

    public function contact()
    {
        return view('storefront.contact.contact-us');
    }

    public function contactSend(Request $request)
    {
        dd($request);
        // Validate the form data
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        // Get the form data
        $name = $request->input('name');
        $email = $request->input('email');
        $message = $request->input('message');
      
   
        Mail::to('no-reply@met4-digital.tech')->send(new ContactUsMail($name, $email, $message));
        
        return redirect('/contact-us')->with('success', 'Message sent successfully!');

    }
}
