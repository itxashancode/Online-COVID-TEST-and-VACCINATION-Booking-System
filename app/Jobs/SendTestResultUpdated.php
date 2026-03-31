<?php

namespace App\Jobs;

use App\Mail\TestResultUpdated;
use App\Models\TestResult;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendTestResultUpdated implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $testResult;

    /**
     * Create a new job instance.
     */
    public function __construct(TestResult $testResult)
    {
        $this->testResult = $testResult;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $patient = $this->testResult->patient;

        if ($patient && $patient->email) {
            Mail::to($patient->email)->send(new TestResultUpdated($this->testResult));
        }
    }
}
