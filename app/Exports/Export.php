<?php
namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;
use Maatwebsite\Excel\Events\BeforeSheet;

class Export implements FromView, WithColumnFormatting ,WithStyles ,WithEvents ,WithColumnWidths
{
        public function __construct($view, $data = "")
{
    $this->view = $view;
    $this->data = $data;
}
    public function view(): View
    {   
        return view($this->view,$this->data);
    }
      public function columnWidths(): array
    {
        return [
            'A' => 5,
            'B' => 25, 
            'C' => 25,
            'D' => 25,
            'E' => 20,
            'F' => 30,
            'G' => 15,
            'H' => 15,  
            'I' => 15,
            'J' => 25,
            'K' => 25,
        ];
    }
     public function columnFormats(): array
    {
        return [
             // 'D' => NumberFormat::FORMAT_TEXT,
            'F' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED2,
            'G' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED2,
            'H' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED2,
            'J' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED2,
            'K' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED2,
            
        ];
    }

    // public static function beforeWriting(BeforeWriting $event)
    // {
    //     $event->sheet->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
    //     $event->sheet->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
    // }
        public function registerEvents(): array
    {
        return [
            BeforeSheet::class => function (BeforeSheet $event) {
                $event->sheet
                    ->getPageSetup()
                    ->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
            },
        ];
    }
  
      public function styles(Worksheet $sheet)
    {
        $line ="B";
        $sheet->getStyle($line)->getNumberFormat()->setFormatCode('000000000000000');
        $line1 ="C";
        $sheet->getStyle($line1)->getNumberFormat()->setFormatCode('0000000000000');
    }


}


