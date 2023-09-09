<?php

namespace Vanguard\Http\Controllers\Web\Front;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Vanguard\ContactUs;
use Vanguard\Http\Controllers\Controller;

class ClientController extends Controller
{
    public function contactUs(Request $request)
    {
        $contact = new ContactUs();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->message = $request->message;
        $contact->save();
    }

}
