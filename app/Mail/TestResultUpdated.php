<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\TestResult;

class TestResultUpdated extends Mailable
{
    use Queueable, SerializesModels;

    public $testResult;

    /**
     * Create a new message instance.
     */
    public function __construct(TestResult $testResult)
    {
        $this->testResult = $testResult;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Your COVID-19 Test Result is Ready')
                    ->markdown('emails.test-result.updated');
    }
}
