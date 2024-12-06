<?php

namespace App\Jobs;

use App\Mail\Enquiry;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class ContactUsJob implements ShouldQueue
{
    use Queueable;
    protected $data;
    /**
     * Create a new job instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $mailable = new Enquiry($this->data);
        Mail::to(env('MAIL_TO_ADDRESS'))->send($mailable);
    }
}
