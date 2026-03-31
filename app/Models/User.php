<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles; // Add Spatie HasRoles trait for role management

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles; // Include HasRoles trait

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'city',
        'user_type',
        'status',
    ];

    /**
     * User belongs to a Hospital (if they are a hospital admin).
     * This inverse relationship allows us to get hospital from user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function hospital()
    {
        return $this->hasOne(Hospital::class);
    }

    /**
     * User has many Appointments as a Patient.
     * For patient users, this returns all their appointment bookings.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'patient_id');
    }

    /**
     * User has many TestResults as a Patient.
     * For patient users, this returns their COVID test results.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function testResults()
    {
        return $this->hasMany(TestResult::class, 'patient_id');
    }

    /**
     * User has many VaccinationRecords as a Patient.
     * For patient users, this returns their vaccination history.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vaccinationRecords()
    {
        return $this->hasMany(VaccinationRecord::class, 'patient_id');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
