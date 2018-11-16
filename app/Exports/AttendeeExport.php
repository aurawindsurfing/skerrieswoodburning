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
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Sheet;
use App\Invoice;


class AttendeeExport implements FromQuery, WithHeadings, WithColumnFormatting, WithMapping, WithEvents
{

    private $count = 1;

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
            $this->count++,
            isset($booking->name) ? $booking->name : '',
            isset($booking->surname) ? $booking->surname : '',
            $booking->confirmed ? 'YES' : '',
            isset($booking->phone) ? $booking->phone : '',
            // isset($booking->email) ? $booking->email : '',
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
            '',
            'Name',
            'Surname',
            '',
            'Phone',
            // 'Email',
            'Rate',
            'Inv',
            'Company',
            'Contact',
            'Notes'
            
        ];
    }

    /**
     * @return array
     */
    public function columnFormats(): array
    {
        return [
            'E' => "### #######"
        ];
    }


    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            BeforeSheet::class  => function(BeforeSheet $event) {
                
                $event->sheet->append([' ', 'Date:', $this->course->date->format('Y-m-d')]);
                $event->sheet->append([' ', 'Course:', $this->course->course_type->name]);
                $event->sheet->append([' ', 'Tutor:', $this->course->tutor->name]);
                $event->sheet->append([' ', 'Venue:', $this->course->venue->name]);
                $event->sheet->getStyle('A1:F4')->getFont()->setSize(14);
                $event->sheet->append([' ']);
                $event->sheet->append([' ']);
            },
            AfterSheet::class    => function(AfterSheet $event) {

                $event->sheet->getPageSetup()->setPaperSize(10);
                $event->sheet->getPageSetup()->setOrientation('landscape');
                $event->sheet->getDelegate()->getColumnDimension('A')->setWidth(5); //id
                $event->sheet->getDelegate()->getColumnDimension('B')->setWidth(15); //name
                $event->sheet->getDelegate()->getColumnDimension('C')->setWidth(15); //surname
                $event->sheet->getDelegate()->getColumnDimension('D')->setWidth(4); //confirm
                $event->sheet->getDelegate()->getColumnDimension('E')->setWidth(12); //phone
                $event->sheet->getDelegate()->getColumnDimension('F')->setWidth(6); //rate
                $event->sheet->getDelegate()->getColumnDimension('G')->setWidth(7); //invoice
                $event->sheet->getDelegate()->getColumnDimension('H')->setWidth(25); //company
                $event->sheet->getDelegate()->getColumnDimension('I')->setWidth(16); //contact
                $event->sheet->getDelegate()->getColumnDimension('J')->setWidth(16); //notes



                $tableHeaders = ('B7:J7');
                $event->sheet->getStyle($tableHeaders)->getFont()->setSize(14);
                $event->sheet->getStyle($tableHeaders)->getAlignment()->setHorizontal('right');
                $event->sheet->getStyle($tableHeaders)->applyFromArray(
                    [
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => 'thin',
                                'color' => ['argb' => '00000000'],
                            ],
                        ]
                    ]);

                $tableCells = ('B8:' . $event->sheet->getHighestColumn() . $event->sheet->getHighestRow());
                $event->sheet->getDelegate()->getPageSetup()->setFitToWidth(true);
                $event->sheet->getStyle($tableCells)->getFont()->setSize(12);
                $event->sheet->getStyle($tableCells)->getAlignment()->setHorizontal('right');
                $event->sheet->getStyle($tableCells)->applyFromArray(
                    [
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => 'thin',
                                'color' => ['argb' => '00000000'],
                            ],
                        ]
                    ]);

                for ($row = 7; $row <= $event->sheet->getHighestRow(); ++$row) {
                    $event->sheet->getRowDimension($row)->setRowHeight(25);
                }

                
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
