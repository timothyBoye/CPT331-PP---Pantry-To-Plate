<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\InboxMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactFormRequest;
use App\Admin;

/**
 * Class ContactController
 *
 * Provides view display and mail form posting functionality for the contact page opf pantry to plate
 *
 * @package App\Http\Controllers
 */
Class ContactController extends Controller
{
    /**
     * Displays the contact page which contains a form for the user to fill in to get in contact with us
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show()
    {
        return view('contact');
    }

    /**
     * Accepts a filled in contact form request from the user and forwards it to the admin inbox for review.
     *
     * @param ContactFormRequest $message
     * @param Admin $admin
     * @return \Illuminate\Http\RedirectResponse
     */
    public function mailToAdmin(ContactFormRequest $message, Admin $admin)
    {   //send the admin an notification
        $admin->notify(new InboxMessage($message));
        // redirect the user back
        return redirect()->back()->with('message', 'thanks for the message! We will get back to you soon!');
    }
}
