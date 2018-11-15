<?php

namespace App\Exports;

use App\Booking;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Sheet;
use App\Invoice;


class AttendeeExport implements FromQuery, WithHeadings, ShouldAutoSize, WithColumnFormatting, WithMapping, WithEvents
{

    /**
     * __construct
     *
     * @param \App\Course $course
     * @return void
     */
    public function __construct(\App\Course $course)
    {
        $this->course = $course;
    }


    public function register()
    {
        // Sheet::macro('setOrientation', function (Sheet $sheet, $orientation) {
        //     $sheet->getDelegate()->getPageSetup()->setOrientation($orientation);
        // });
    }

     
    /**
     * query
     *
     * @return void
     */
    public function query()
    {
        return Booking::query()
            ->select('name',
                    'surname',
                    'confirmed',
                    'phone',
                    'email',
                    'rate',
                    'invoice_id',
                    'company_id',
                    'contact_id')
            ->where('course_id', $this->course->id);
    }

    
    public function map($booking): array
    {
        return [
            isset($booking->name) ? $booking->name : '',
            isset($booking->surname) ? $booking->surname : '',
            $booking->confirmed ? 'YES' : '',
            isset($booking->phone) ? $booking->phone : '',
            isset($booking->email) ? $booking->email : '',
            isset($booking->rate) ? $booking->rate : '',
            isset($booking->invoice->number) ? $booking->invoice->number : '',
            isset($booking->company->name) ? $booking->company->name : '',
            isset($booking->contact->name) ? $booking->contact->name : '',
        ];
    }

    /**
     * headings
     *
     * @return void
     */
    public function headings(): array
    {
        return [
            'Name',
            'Surname',
            'Confirmed',
            'Phone',
            'Email',
            'Rate',
            'Invoice',
            'Company',
            'Contact',
            
        ];
    }

    /**
     * @return array
     */
    public function columnFormats(): array
    {
        return [
            'D' => "### #######"
        ];
    }


    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {

                $headerRange = 'A1:W1';

                $cellRange = ('A1:' . $event->sheet->getDelegate()->getHighestColumn() . $event->sheet->getDelegate()->getHighestRow());

                $event->sheet->getDelegate()->getPageSetup()->setFitToWidth(true);
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
                $event->sheet->getDelegate()->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
                $event->sheet->getStyle($cellRange)->applyFromArray(
                    [
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                                'color' => ['argb' => '00000000'],
                            ],
                        ]
                    ]);

            },
        ];
    }
}




// $sheet->setOrientation('landscape');
// $sheet->setPaperSize(1);
// $sheet->setScale('100');
// $sheet->setFitToHeight(false);
// $sheet->setFitToWidth(true);
// $sheet->setPageMargin(0.25);

// $sheet->setWidth([
//     'A'     =>  25,
//     'B'     =>  11,
//     'C'     =>  11,
//     'D'     =>  11,
//     'E'     =>  11,
//     'F'     =>  11,
//     'G'     =>  11,
//     'H'     =>  11,
//     'I'     =>  40
// ]);

// $sheet->getStyle('I:I')->getAlignment()->setWrapText(true);
