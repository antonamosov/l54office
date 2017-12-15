<?php

namespace App;

use Maatwebsite\Excel\Facades\Excel;

class GenerateExcel
{
    /**
     * Core function for generate Excel file
     *
     * @param $fileName
     * @param $header
     * @param $body
     * @param $footer
     */
    public function create($fileName, $header, $body, $footer = null)
    {
       // $excel = App::make('excel');

        Excel::create($fileName,function ($excel) use ($fileName, $header, $body, $footer)
        {
            $excel->sheet($fileName, function ($sheet) use ($fileName, $header, $body, $footer)
            {
                $sheet->setHeight(1, 50);
                $sheet->setHeight(3, 40);


                $sheet->cells('A1:E1', function ($cells)
                {
                    $cells->setFontSize(14);
                });

                $sheet->mergeCells('A1:E1');

                // Title
                $sheet->row(1, [ $fileName ]);

                // Font size
                $columns = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U'];
                $sheet->cells('A4:' . $columns[count($header)] . (count($body) + 4), function ($cells)
                {
                    $cells->setFontSize(10);
                });

                // Border
                $sheet->setBorder('A3:' . $columns[count($header)] . (count($body) + 4), 'thin');

                // Headers
                $sheet->row(3, array_merge(
                    ['#'],
                    $header
                ));

                $row_id = 4;
                for($i = 0; $i < count($body); $i++)
                {
                    $sheet->row($row_id++, array_merge(
                        [$i + 1],
                        $body[$i]
                    ));
                }

                if($footer !== null) {
                    $sheet->row($row_id++, $footer);
                }
            });
        })->export('xlsx');
    }
}
