<?php

namespace App\Jobs;

use App\Mail\HospitalStatusChanged;
use App\Models\Hospital;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendHospitalStatusChanged implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $hospital;
    public $status;

    /**
     * Create a new job instance.
     */
    public function __construct(Hospital $hospital, string $status)
    {
        $this->hospital = $hospital;
        $this->status = $status;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $user = $this->hospital->user;

        if ($user && $user->email) {
            Mail::to($user->email)->send(new HospitalStatusChanged($this->hospital, $this->status));
        }
    }
}
