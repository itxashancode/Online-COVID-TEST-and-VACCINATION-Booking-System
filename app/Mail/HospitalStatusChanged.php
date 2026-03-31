<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Hospital;

class HospitalStatusChanged extends Mailable
{
    use Queueable, SerializesModels;

    public $hospital;
    public $status;

    /**
     * Create a new message instance.
     */
    public function __construct(Hospital $hospital, string $status)
    {
        $this->hospital = $hospital;
        $this->status = $status;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Hospital Registration Status Updated')
                    ->markdown('emails.hospital.status-changed');
    }
}
