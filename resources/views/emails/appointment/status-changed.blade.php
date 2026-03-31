<x-mail::message>
# Appointment Status Update

Dear **{{ $appointment->patient->name }}**,

Your appointment request has been **{{ $status }}**.

## Appointment Details

- **Hospital**: {{ $appointment->hospital->hospital_name }}
- **Type**: {{ ucfirst(str_replace('_', ' ', $appointment->appointment_type)) }}
- **Date**: {{ $appointment->appointment_date->format('F d, Y') }}
- **Time**: {{ $appointment->appointment_time ?? 'Not specified' }}

@if($status === 'approved')
Your appointment has been approved. Please visit the hospital at the scheduled time.

<x-mail::button :url="url('/patient/appointments')">
View My Appointments
</x-mail::button>
@elseif($status === 'rejected')
We're sorry, but your appointment request has been rejected. Please consider booking with another hospital or contact support for assistance.

<x-mail::button :url="url('/patient/appointments/create')">
Book Another Appointment
</x-mail::button>
@else
Your appointment status has been updated to: **{{ $status }}**.

<x-mail::button :url="url('/patient/appointments')">
View Details
</x-mail::button>
@endif

---

If you have any questions, please contact the hospital directly.

Thank you,<br>
{{ config('app.name') }} Team
</x-mail::message>
