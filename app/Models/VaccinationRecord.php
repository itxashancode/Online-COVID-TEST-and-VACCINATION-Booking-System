<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VaccinationRecord extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'appointment_id',    // ID of the appointment
        'patient_id',        // ID of the patient (redundant but useful)
        'hospital_id',       // ID of the hospital (redundant but useful)
        'vaccine_id',        // ID of the vaccine administered
        'dose',              // 'first', 'second', or 'booster'
        'vaccination_date',  // Date of vaccination
        'status',            // 'completed' or 'pending'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'vaccination_date' => 'date',
    ];

    /**
     * VaccinationRecord belongs to an Appointment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    /**
     * VaccinationRecord belongs to a Patient (User).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    /**
     * VaccinationRecord belongs to a Hospital.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }

    /**
     * VaccinationRecord belongs to a Vaccine.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vaccine()
    {
        return $this->belongsTo(Vaccine::class);
    }
}
