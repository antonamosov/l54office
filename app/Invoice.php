<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'id',
        'fiscal_code',
        'email',
        'name',
        'surname',
        'city_id',
        'street',
        'number',
        'sum',
        'total',
        'description',
        'send_at',
        'student_id',
        'progressive_number',
        'payment_type'
    ];

    protected $dates = [
        'send_at'
    ];

    public function Student()
    {
        return $this->belongsTo(Student::class);
    }

    public function lastStudentInvoice($studentId)
    {
        return Invoice::whereStudentId($studentId)->orderBy('id', 'desc')->first();
    }

    public function descriptionPart()
    {
        $partSize = 60;
        $arr = explode(';', $this->description);
        $newArr = [];

        foreach ($arr as $key => $value) {
            if (strlen($value) > $partSize && trim($value)) {
                $firstPart = substr($value, 0, $partSize);
                $posEndFirstPart = strripos($firstPart, '-');
                $firstPart = substr($firstPart, 0, $posEndFirstPart);

                $posStartSecondPart = strlen($firstPart);
                $posEndSecondPart = strlen($value);
                $newArr[] = $firstPart;

                $secondPart = substr($value, $posStartSecondPart, $posEndSecondPart);
                $newArr[] = $secondPart . ';';
            }
            elseif (trim($value)) {
                $newArr[] = $value . ';';
            }
        }

        return implode('<br>', $newArr);

    }

    public function description($student)
    {
        $description = '';
        foreach($student->exams as $exam) {
            $description .= $exam->title() . ' - ' . $student->enrolment_exam->format('Y-m-d') . '; ';
        }

        return $description;
    }

    public function paymentTypes()
    {
        $output = '';
        $types = json_decode($this->student->payment_type);
        //dd($types);
        if(is_array($types)) {
            $typeNames = [];
            foreach($types as $key => $typeId) {
                $typeNames[] = config('payments.types.' . $typeId);
            }

            $output = implode(', ', $typeNames);
        }

        return $output;
    }

    public function sumWithoutVAT()
    {
        return round($this->total + $this->total * 0.22, 2);
    }

}
