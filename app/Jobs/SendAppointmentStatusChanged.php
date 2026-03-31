<?php

namespace App\Jobs;

use App\Mail\AppointmentStatusChanged;
use App\Models\Appointment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendAppointmentStatusChanged implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $appointment;
    public $status;

    /**
     * Create a new job instance.
     */
    public function __construct(Appointment $appointment, string $status)
    {
        $this->appointment = $appointment;
        $this->status = $status;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $patient = $this->appointment->patient;

        if ($patient && $patient->email) {
            Mail::to($patient->email)->send(new AppointmentStatusChanged($this->appointment, $this->status));
        }
    }
}
