<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;

class TxtController extends Controller
{
    private $fileName = "university_txt.txt";
    private $columnWidths = [ 10, 10, 50, 50, 50, 50, 24, 50, 10 ];
    private $sortKeys = [
        'university_code',
        'personal_code',
        'surname',
        'name',
        'city',
        'nation',
        'date_of_birth',
        'email',
        'enrolment_exam',
    ];

    public function prepareValue($value, $key)
    {
        switch($key) {
            case 'city' :
                return $value;
            case 'date_of_birth' :
                return date("Ymd", strtotime($value));
            case 'enrolment_exam' :
                return date("Ymd", strtotime($value));
        }

        return $value;
    }

    public function university()
    {
        $f = fopen(base_path('logs') . "/" . $this->fileName, 'w');
        $students = Student::orderBy('surname', 'asc')->get()->toArray();
        $i = 0;
        foreach($students as $student) {
            $students[$i] = array_only($student, $this->sortKeys);
            uksort($students[$i], function($a, $b) {
                $keyA = array_search($a, $this->sortKeys);
                $keyB = array_search($b, $this->sortKeys);

                return $keyA - $keyB;
            });
            $i++;
        }

        $content = '';

        foreach($students as $student) {
            $row = '';
            $columnId = 0;
            foreach($student as $key => $value) {
                $value = $this->prepareValue($value, $key);
                $column = $value;
                if(strlen($column) > $this->columnWidths[$columnId]) {
                    $column = substr($column, 0, $this->columnWidths[$columnId]);
                }
                else {
                    do {
                        $column .= ' ';
                    }
                    while(strlen($column) < $this->columnWidths[$columnId]);
                }
                $row .= $column;
                $columnId++;
            }
            $content .= $row . "\r\n";
        }

        fwrite($f, $content);

        return response()->download(base_path('logs') . "/" . $this->fileName);
    }
}
