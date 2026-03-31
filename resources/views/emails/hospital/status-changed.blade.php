<x-mail::message>
# Hospital Registration Status

Dear **{{ $hospital->hospital_name }}**,

Your hospital registration request has been **{{ $status }}**.

## Registration Details

- **Hospital Name**: {{ $hospital->hospital_name }}
- **Address**: {{ $hospital->address }}
- **City**: {{ $hospital->city }}
- **Phone**: {{ $hospital->phone }}

@if($status === 'approved')
恭喜! Your hospital is now approved and patients can book appointments at your facility.

You can now access your hospital dashboard to manage appointments and update test results.

<x-mail::button :url="url('/hospital/dashboard')">
Access Hospital Dashboard
</x-mail::button>
@else
We regret to inform you that your registration request has been rejected. Please contact the administrator for more information or to reapply.
@endif

---

If you have any questions, please contact the system administrator.

Thank you,<br>
{{ config('app.name') }} Team
</x-mail::message>
