<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>COVID-19 Test Certificate</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
            background: linear-gradient(90deg, #667eea, #764ba2, #f093fb, #f5576c);
            background-size: 300% 100%;
            animation: gradient 8s ease infinite;
        }
        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
            color: #667eea;
            font-weight: 600;
            margin-bottom: 15px;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-bottom: 2px solid #667eea;
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
            border-left: 4px solid #667eea;
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
        .result-box {
            text-align: center;
            padding: 30px;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            border-radius: 15px;
            margin: 20px 0;
        }
        .result-label {
            font-size: 14px;
            color: #64748b;
            margin-bottom: 10px;
        }
        .result-value {
            font-size: 36px;
            font-weight: 700;
            text-transform: uppercase;
            padding: 15px 40px;
            border-radius: 50px;
            display: inline-block;
        }
        .result-positive {
            color: #dc2626;
            background: #fee2e2;
            border: 3px solid #dc2626;
        }
        .result-negative {
            color: #16a34a;
            background: #dcfce7;
            border: 3px solid #16a34a;
        }
        .result-pending {
            color: #ea580c;
            background: #fed7aa;
            border: 3px solid #ea580c;
        }
        .notes {
            background: #fef3c7;
            border-left: 4px solid #f59e0b;
            padding: 15px;
            border-radius: 8px;
            margin-top: 20px;
        }
        .notes strong {
            color: #92400e;
        }
        .footer {
            background: #1e293b;
            color: white;
            padding: 20px 40px;
            text-align: center;
            font-size: 12px;
        }
        .footer .logo {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 8px;
            color: #667eea;
        }
        .verification {
            margin-top: 10px;
            font-family: monospace;
            background: rgba(255,255,255,0.1);
            padding: 8px 15px;
            border-radius: 5px;
            display: inline-block;
        }
        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 120px;
            color: rgba(102, 126, 234, 0.08);
            font-weight: 700;
            white-space: nowrap;
            pointer-events: none;
            z-index: 0;
        }
        .header, .content, .footer {
            position: relative;
            z-index: 1;
        }
    </style>
</head>
<body>
    <div class="certificate">
        <div class="watermark">VERIFIED</div>

        <div class="header">
            <div class="icon">🩺</div>
            <h1>COVID-19 Test Certificate</h1>
            <p>Official Medical Document</p>
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
                <div class="section-title">Test Details</div>
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
                        <div class="info-label">Test Date</div>
                        <div class="info-value">{{ $testResult->result_date->format('F d, Y') }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Report Date</div>
                        <div class="info-value">{{ $testResult->created_at->format('F d, Y') }}</div>
                    </div>
                </div>
            </div>

            <div class="section">
                <div class="result-box">
                    <div class="result-label">Test Result</div>
                    <div class="result-value {{ $testResult->result === 'positive' ? 'result-positive' : ($testResult->result === 'negative' ? 'result-negative' : 'result-pending') }}">
                        {{ strtoupper($testResult->result) }}
                    </div>
                </div>

                @if($testResult->doctor_notes)
                <div class="notes">
                    <strong>Doctor's Notes:</strong><br>
                    {{ $testResult->doctor_notes }}
                </div>
                @endif
            </div>

            @if($appointment && $appointment->appointment_type == 'covid_test')
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
                Certificate ID: TR-{{ $testResult->id }}-{{ $testResult->created_at->format('Ymd') }}
            </div>
            <p style="margin-top: 10px; opacity: 0.7;">
                Generated: {{ $generated_at->format('F d, Y H:i:s') }}
            </p>
        </div>
    </div>
</body>
</html>
