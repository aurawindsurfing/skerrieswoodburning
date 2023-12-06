<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Notifications\WebsiteEnquiryCIT;
use App\User;

class ContactFormController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function send(ContactRequest $request)
    {
        $data = [
            'name' => $request->name,
            'company' => $request->company,
            'type' => $request->type,
            'phone' => $request->phone,
            'email' => $request->email,
            'enquiry' => $request->enquiry,
        ];

        User::find(4)->notify(new WebsiteEnquiryCIT($data));

        return back()->with('email-success', 'message');
    }
}
