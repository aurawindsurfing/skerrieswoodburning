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
     * @param \App\Http\Requests\ContactRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function send(ContactRequest $request)
    {
        User::find(4)->notify(new WebsiteEnquiryCIT($request));
        User::find(1)->notify(new WebsiteEnquiryCIT($request));

        User::find(3)->notify(new WebsiteEnquiryCIT($request));

        return back()->with('email-success', 'message');

    }
}
