<?php

namespace App\Http\Controllers;

use App\GenerateExcel;
use App\Student;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;

class ExcelController extends Controller
{
    /**
     * @var Student
     */
    private $student;

    /**
     * @var Student
     */
    private $studentModel;


    public function create(GenerateExcel $excel, Request $request)
    {
        try {
            $table = json_decode($request->input('table'));
            $fileName = $request->input('header');
            $header = []; $body = [];
            for($i = 0; $i < count($table->myRows); $i++) {
                $header = [];
                $body[] = [];
                foreach($table->myRows[$i] as $columnName => $cell) {
                    $header[] = trim($columnName);
                    $body[$i][] = trim($cell);
                }
            }
            $excel->create($fileName, $header, $body);
        }
        catch(\Exception $e) {
            return response($e->getTraceAsString());
        }
    }

    public function uploadExcelFilePageStep1()
    {
        return view('import.upload_excel');
    }

    public function uploadCSVFilePageStep2()
    {
        return view('import.upload_csv');
    }

    public function postUploadExcel(Request $request, Excel $excel)
    {
        $this->validate($request, [
            'excel_file' => 'required'
        ]);

        $fileName = $request->file('excel_file')->getClientOriginalName();
        $request->file('excel_file')->move(base_path('logs/'), $fileName);

        $excel->load(base_path('logs/') . $fileName, function($reader) {

        })->convert('csv');
    }

    public function postUploadCSV(Request $request, Student $student)
    {
        $this->validate($request, [
            'csv_file' => 'required'
        ]);

        $this->studentModel = $student;
        $fileName = $request->file('csv_file')->getClientOriginalName();
        $request->file('csv_file')->move(base_path('logs/'), $fileName);

        $f = fopen(base_path('logs/') . $fileName, 'r');

        $arr = []; $updatedStudentsCount = 0;

        do {
            $arr[] = fgetcsv($f);
        }
        while (! feof($f));

        fclose($f);

        foreach ($arr as $key => $row) {
            if (is_array($row)) {
                if (count($row) > 21) {
                    if ($this->checkName($row[5])) {
                        echo $row[5] . '<br>';
                        $this->saveStudent($row[16], $row[18], $row[21]);
                        $updatedStudentsCount++;
                    }
                }
            }
        }

        return redirect()->route('import.excel')->withMsg("$updatedStudentsCount students updated.");
    }

    private function checkName($name)
    {
        $nameSurname = explode(' ', $name);
        $name = isset($nameSurname[0]) ? $nameSurname[0] : "";
        $surname = isset($nameSurname[1]) ? $nameSurname[1] : "";

        $this->student = $this->studentModel->where('name', $name)->where('surname', $surname)->first();

        if ($this->student) {

            return true;
        }
        else {
            return false;
        }
    }

    private function saveStudent($l, $r, $tot)
    {
        $this->student->update([
            'listening' => $l,
            'reading' => $r,
            'total_score' => $tot,
        ]);
    }





}
