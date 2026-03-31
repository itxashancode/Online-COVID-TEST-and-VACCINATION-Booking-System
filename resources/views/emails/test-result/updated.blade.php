<x-mail::message>
# COVID-19 Test Result

Dear **{{ $testResult->patient->name }}**,

Your COVID-19 test result from **{{ $testResult->hospital->hospital_name }}** is now available.

## Test Result Summary

- **Result**: <span style="font-weight: bold; color: {{ $testResult->result === 'positive' ? '#dc2626' : ($testResult->result === 'negative' ? '#16a34a' : '#ea580c') }};">{{ ucfirst($testResult->result) }}</span>
- **Test Date**: {{ $testResult->result_date->format('F d, Y') }}
- **Hospital**: {{ $testResult->hospital->hospital_name }}
- **Address**: {{ $testResult->hospital->address }}

@if($testResult->doctor_notes)
## Doctor's Notes
{{ $testResult->doctor_notes }}
@endif

<x-mail::button :url="url('/patient/results')">
View Full Results
</x-mail::button>

---

### Important Health Information

@if($testResult->result === 'positive')
**If you tested positive for COVID-19:**
- Isolate according to local health guidelines
- Monitor your symptoms closely
- Seek medical attention if symptoms worsen
- Inform close contacts to get tested
@elseif($testResult->result === 'negative')
**If you tested negative for COVID-19:**
- Continue following preventive measures
- You may still need to quarantine based on exposure
- Consider retesting if symptoms develop
@else
**Your result is still pending.** You will be notified once it is available.
@endif

For any questions, please contact the hospital directly.

Thank you,<br>
{{ config('app.name') }} Team
</x-mail::message>
