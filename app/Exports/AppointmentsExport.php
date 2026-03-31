<?php

namespace App\Exports;

use App\Models\Appointment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

/**
 * AppointmentsExport
 *
 * This class handles exporting appointment data to Excel format.
 * It defines:
 * - Column headings
 * - Data mapping from Appointment model to spreadsheet rows
 * - Styling for the worksheet
 * - Auto-sizing columns for better readability
 *
 * Usage: return Excel::download(new AppointmentsExport($appointments), 'appointments.xlsx');
 */
class AppointmentsExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{
    /**
     * @var \Illuminate\Database\Eloquent\Collection  Collection of appointments to export
     */
    protected $appointments;

    /**
     * Constructor receives the filtered appointments collection.
     *
     * @param  mixed  $appointments  Collection of Appointment models
     */
    public function __construct($appointments)
    {
        $this->appointments = $appointments;
    }

    /**
     * Returns the collection of appointments to be exported.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->appointments;
    }

    /**
     * Define column headings for the Excel file.
     * These will appear as the first row in the spreadsheet.
     *
     * @return array
     */
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

    /**
     * Map each appointment to a row in the Excel sheet.
     * This method transforms each Appointment model into an array of cell values.
     *
     * @param  mixed  $appointment  The Appointment model instance
     * @return array
     */
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

    /**
     * Apply styles to the worksheet.
     * Headers will be bold and have background color.
     *
     * @param  Worksheet  $sheet
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1 => ['font' => ['bold' => true, 'size' => 12]],

            // Apply borders to all cells
            'A1:I' . ($this->appointments->count() + 1) => [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => '000000'],
                    ],
                ],
            ],

            // Header background
            'A1:I1' => [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['argb' => 'E0E0E0'],
                ],
            ],
        ];
    }
}
