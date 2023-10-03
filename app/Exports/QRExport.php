<?php

namespace App\Exports;

use App\Models\Qr;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use \Maatwebsite\Excel\Sheet;


class QRExport extends DefaultValueBinder implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize, WithEvents, WithColumnFormatting,WithCustomValueBinder,WithTitle
{


    //Constructor
    public function __construct()
    {
        $this->range= 'A1:G1';
    }

    public function title(): string
    {
        return 'QR List';
    }


    public function bindValue(Cell $cell, $value)
    {
        if (is_numeric($value)) {
            $cell->setValueExplicit($value, DataType::TYPE_STRING);

            return true;
        }

        // else return default behavior
        return parent::bindValue($cell, $value);
    }

    //Event for customization
    public function registerEvents(): array
    {
        Sheet::macro('styleCells', function (Sheet $sheet, string $cellRange, array $style) {
            $sheet->getDelegate()->getStyle($cellRange)->applyFromArray($style);
        });
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = $this->range;
                $event->sheet->getStyle($this->range)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('5269CF');
                $event->sheet->styleCells(
                   $this->range,
                   [
                       'font' => [
                            'name'      =>  'Arial',
                            'size'      =>  10,
                            'bold'      =>  true,
                            'color'     =>  ['rgb' => 'FFFFFF']
                        ]
                   ]
                );
                $event->sheet->setAutoFilter($this->range);
            },
        ];
    }


    //Mapping
    public function map($log): array
    {

        return [
            $log->uid,
            $log->encrypted_uid,
            env("DASHBOARD_URL").'/qrcode/'.  $log->encrypted_uid .'.tiff',
            $log->pin,
            $log->title,
            $log->desc,
            $log->created_at
        ];
    }


    //Column Formatting
    //Reference : https://laravel-excel.maatwebsite.nl/2.1/reference-guide/formatting.html
    public function columnFormats(): array
    {
        return [
            'G' => NumberFormat::FORMAT_DATE_DDMMYYYY
        ];
    }


    //Heading
    public function headings(): array
    {
       return [             
            'Serial Code',
            'Encrypted Code',
            'QR URL',
            'PIN',
            'Product Name',
            'Product Description',
            'Created At',
       ];
    }


    //Collection
    public function collection()
    {
        return Qr::all();
    }
}
