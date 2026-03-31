<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaccine extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'vaccine_name',     // Name of the vaccine (e.g., Pfizer, Moderna)
        'description',      // Optional description
        'availability',     // 'available' or 'unavailable'
    ];

    /**
     * Vaccine has many VaccinationRecords.
     * Track which vaccinations used this vaccine type.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vaccinationRecords()
    {
        return $this->hasMany(VaccinationRecord::class);
    }
}
