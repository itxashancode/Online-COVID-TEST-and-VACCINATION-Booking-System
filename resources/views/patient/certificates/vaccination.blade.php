<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Vaccination Certificate</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            padding: 40px;
            min-height: 100vh;
        }
        .certificate {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            overflow: hidden;
            position: relative;
        }
        .certificate::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 12px;
            background: linear-gradient(90deg, #10b981, #059669, #34d399, #6ee7b7);
            background-size: 300% 100%;
            animation: gradient 8s ease infinite;
        }
        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .header {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            padding: 40px;
            text-align: center;
            position: relative;
        }
        .header h1 {
            font-size: 32px;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        }
        .header p {
            font-size: 16px;
            opacity: 0.9;
        }
        .header .icon {
            font-size: 48px;
            margin-bottom: 15px;
        }
        .content {
            padding: 40px;
        }
        .section {
            margin-bottom: 30px;
        }
        .section-title {
            font-size: 18px;
            color: #10b981;
            font-weight: 600;
            margin-bottom: 15px;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-bottom: 2px solid #10b981;
            padding-bottom: 8px;
        }
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        .info-item {
            padding: 15px;
            background: #f8fafc;
            border-radius: 10px;
            border-left: 4px solid #10b981;
        }
        .info-label {
            font-size: 12px;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 5px;
        }
        .info-value {
            font-size: 16px;
            color: #1e293b;
            font-weight: 500;
        }
        .vaccine-box {
            text-align: center;
            padding: 30px;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            border-radius: 15px;
            margin: 20px 0;
        }
        .vaccine-icon {
            font-size: 64px;
            margin-bottom: 15px;
        }
        .vaccine-name {
            font-size: 28px;
            font-weight: 700;
            color: #059669;
            margin-bottom: 10px;
        }
        .dose-badge {
            display: inline-block;
            padding: 10px 30px;
            background: #10b981;
            color: white;
            border-radius: 50px;
            font-size: 16px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .status-badge {
            display: inline-block;
            padding: 8px 25px;
            background: #dcfce7;
            color: #16a34a;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 600;
            margin-top: 15px;
        }
        .shield-icon {
            font-size: 100px;
            text-align: center;
            opacity: 0.15;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        .footer {
            background: #1e293b;
            color: white;
            padding: 20px 40px;
            text-align: center;
            font-size: 12px;
            position: relative;
        }
        .footer .logo {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 8px;
            color: #10b981;
        }
        .verification {
            margin-top: 10px;
            font-family: monospace;
            background: rgba(255,255,255,0.1);
            padding: 8px 15px;
            border-radius: 5px;
            display: inline-block;
        }
        .header, .content, .footer {
            position: relative;
            z-index: 1;
        }
    </style>
</head>
<body>
    <div class="certificate">
        <div class="shield-icon">🛡️</div>

        <div class="header">
            <div class="icon">💉</div>
            <h1>Vaccination Certificate</h1>
            <p>Official Immunization Record</p>
        </div>

        <div class="content">
            <div class="section">
                <div class="section-title">Patient Information</div>
                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-label">Full Name</div>
                        <div class="info-value">{{ $patient->name }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Email</div>
                        <div class="info-value">{{ $patient->email }}</div>
                    </div>
                    @if($patient->phone)
                    <div class="info-item">
                        <div class="info-label">Phone</div>
                        <div class="info-value">{{ $patient->phone }}</div>
                    </div>
                    @endif
                    @if($patient->city)
                    <div class="info-item">
                        <div class="info-label">City</div>
                        <div class="info-value">{{ $patient->city }}</div>
                    </div>
                    @endif
                </div>
            </div>

            <div class="section">
                <div class="vaccine-box">
                    <div class="vaccine-icon">🛡️</div>
                    <div class="vaccine-name">{{ $vaccine->vaccine_name ?? 'COVID-19 Vaccine' }}</div>
                    <div class="dose-badge">{{ ucfirst($vaccinationRecord->dose) }} Dose</div>
                    <div class="status-badge">{{ ucfirst($vaccinationRecord->status) }}</div>
                </div>
            </div>

            <div class="section">
                <div class="section-title">Vaccination Details</div>
                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-label">Hospital</div>
                        <div class="info-value">{{ $hospital->hospital_name }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Hospital Address</div>
                        <div class="info-value">{{ $hospital->address }}, {{ $hospital->city }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Vaccination Date</div>
                        <div class="info-value">{{ \Carbon\Carbon::parse($vaccinationRecord->vaccination_date)->format('F d, Y') }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Report Date</div>
                        <div class="info-value">{{ $vaccinationRecord->created_at->format('F d, Y') }}</div>
                    </div>
                </div>
            </div>

            @if($appointment)
            <div class="section">
                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-label">Appointment Type</div>
                        <div class="info-value">{{ ucfirst(str_replace('_', ' ', $appointment->appointment_type)) }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Appointment Date</div>
                        <div class="info-value">{{ $appointment->appointment_date->format('F d, Y') }}</div>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <div class="footer">
            <div class="logo">{{ config('app.name', 'MED-Digi') }}</div>
            <p>This certificate is digitally generated and verified.</p>
            <div class="verification">
                Certificate ID: VAX-{{ $vaccinationRecord->id }}-{{ $vaccinationRecord->created_at->format('Ymd') }}
            </div>
            <p style="margin-top: 10px; opacity: 0.7;">
                Generated: {{ $generated_at->format('F d, Y H:i:s') }}
            </p>
        </div>
    </div>
</body>
</html>
