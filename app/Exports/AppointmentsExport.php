<?php

namespace App\Exports;

use App\Models\Appointment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AppointmentsExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{
    protected $appointments;

    public function __construct($appointments)
    {
        $this->appointments = $appointments;
    }

    public function collection()
    {
        return $this->appointments;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Patient Name',
            'Patient Email',
            'Hospital',
            'Appointment Type',
            'Date',
            'Time',
            'Status',
            'Notes',
            'Created At',
        ];
    }

    public function map($appointment): array
    {
        return [
            $appointment->id,
            $appointment->patient->name ?? 'N/A',
            $appointment->patient->email ?? 'N/A',
            $appointment->hospital->hospital_name ?? 'N/A',
            $appointment->appointment_type == 'covid_test' ? 'COVID-19 Test' : 'Vaccination',
            $appointment->appointment_date->format('Y-m-d'),
            $appointment->appointment_time ?? 'N/A',
            ucfirst($appointment->status),
            $appointment->notes ?? '',
            $appointment->created_at->format('Y-m-d H:i'),
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'size' => 12]],
            'A1:I' . ($this->appointments->count() + 1) => [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => '000000'],
                    ],
                ],
            ],
            'A1:I1' => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['argb' => 'E0E0E0'],
                ],
            ],
        ];
    }
}
