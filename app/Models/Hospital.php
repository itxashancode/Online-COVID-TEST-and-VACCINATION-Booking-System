<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * These fields can be filled via create() or update() methods.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',           // Links to the users table (hospital owner)
        'hospital_name',     // Name of the hospital
        'address',          // Physical address
        'city',             // City where hospital is located
        'phone',            // Contact phone number
        'description',      // Optional description
        'status',           // pending, approved, or rejected
    ];

    /**
     * Hospital belongs to a User (hospital admin/owner).
     * Each hospital record is linked to one user account.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Hospital has many Appointments.
     * Get all appointment bookings for this hospital.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    /**
     * Hospital has many VaccinationRecords.
     * Track vaccination appointments at this hospital.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vaccinationRecords()
    {
        return $this->hasMany(VaccinationRecord::class);
    }

    /**
     * Hospital has many TestResults.
     * Track COVID test results from this hospital.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function testResults()
    {
        return $this->hasMany(TestResult::class);
    }
}
