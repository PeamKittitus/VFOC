<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
class JobMail extends Mailable
{
    use Queueable, SerializesModels;

    public $details;
    public $supject;

    public function __construct($details, $supject)
    {
        $this->details = $details;
        $this->supject = $supject;
    }

    public function build()
    {
        return $this->subject($this->supject)
            ->view('mail/job_mail', compact('article'))
            ->with(['details' => $this->details]);
    }
}
