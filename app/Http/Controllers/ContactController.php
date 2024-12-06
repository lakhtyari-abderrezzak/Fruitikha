<?php

namespace App\Http\Controllers;

use App\Jobs\ContactUsJob;
use App\Mail\Enquiry;
use App\Models\Message as ModelsMessage;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Mail;


class ContactController extends Controller
{
    public function show()
    {
        return view('contact');
    }
    public function sendEnquiry(Request $rquest)
    {
        $data = $rquest->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'phone' => 'required|min:11|numeric',
            'subject' => 'required|nullable',
            'contentMessage' => 'required|min:5',
        ]);
        // send Data To DB
        ModelsMessage::create($data);
        Mail::to(env('MAIL_TO_ADDRESS'))->send(new Enquiry($data));
        //###########
        // Send Email Using queue
        $job = (new ContactUsJob($data));
        dispatch($job);
        return redirect()->back()->with('success', 'Message Was Sent Successfully');
    }
    public function create(){

    }
}
