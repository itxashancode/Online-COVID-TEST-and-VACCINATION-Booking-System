<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'patient_id',
        'hospital_id',
        'appointment_type',
        'appointment_date',
        'appointment_time',
        'status',
        'notes',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'appointment_date' => 'date',
    ];

    /**
     * Appointment belongs to a Patient (User).
     * The user who booked this appointment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    /**
     * Appointment belongs to a Hospital.
     * The hospital where appointment is booked.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }

    /**
     * Appointment has one TestResult.
     * For COVID test appointments, there will be a test result.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function testResult()
    {
        return $this->hasOne(TestResult::class);
    }

    /**
     * Appointment has one VaccinationRecord.
     * For vaccination appointments, there will be a vaccination record.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function vaccinationRecord()
    {
        return $this->hasOne(VaccinationRecord::class);
    }
}
