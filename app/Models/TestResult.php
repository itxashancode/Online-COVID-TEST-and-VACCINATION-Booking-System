<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestResult extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'appointment_id', // ID of the appointment
        'patient_id',     // ID of the patient (redundant but useful for quick queries)
        'hospital_id',    // ID of the hospital (redundant but useful for quick queries)
        'result',         // 'positive', 'negative', or 'pending'
        'doctor_notes',   // Additional notes from doctor
        'result_date',    // Date when result was given
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'result_date' => 'date',
    ];

    /**
     * TestResult belongs to an Appointment.
     * Each test result is linked to one appointment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    /**
     * TestResult belongs to a Patient (User).
     * The patient who took the test.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    /**
     * TestResult belongs to a Hospital.
     * The hospital that conducted the test.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }
}
