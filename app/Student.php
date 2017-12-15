<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Student
 *
 * @property string $id
 * @method find($id)
 */
class Student extends Model
{
    protected $fillable = [
        'id',
        'name',//
        'surname',//
        'fiscal_code',//
        'vat',//
        'personal_code',//
        'university_code',
        'born_in',//
        'city',
        'date_of_birth',//
        'nation',//
        'resident_in',
        'address',//
        'shipping_address',
        'street',//
        'number',//
        'postal_code',
        'province',//
        'phone',//
        'email',//
        'university',//
        'school',//
        'confirmed',
        'enrolment_exam',//
        //'exam_id', // field is deleted
        'exam_already_taken',
        'eat_city',
        'eat_school',
        'eat_date',
        'know_us',
        'exam_date_from',
        'exam_date_to',
        'tan',
        'tat',
        'tas',
        'fts',
        'mail_pre_entry',
        'mail_confirmed',
        'mail_expired',
        'mail_call',
        'mail_score',
        'mail_withdrawal',
        'note',
        'sum',
        'total',
        'description',
        'memo_1',
        'memo_2',
        'invoice_number_1',
        'invoice_number_2',
        'session_id',//
        'order_id',
        'mail_pre_entry_date',
        'mail_confirmed_date',
        'mail_expired_date',
        'mail_call_date',
        'mail_score_date',
        'mail_withdrawal_date',
        'new',
        'mailed',
        'vote',
        'tan_date',
        'tat_date',
        'tas_date',
        'fts_date',
        'expired_sent',
        'payment_type',
        'editing_user_id',
        'editing_time',
        'select_as_memo',
        'created_user_id',
        'updated_user_id',
        'matricola',
        'cap',
        'image',
        'changing_exam_send_date',
        'listening',
        'reading',
        'total_score',
    ];

    protected $dates = [
        'tan_date',
        'tat_date',
        'tas_date',
        'fts_date',
        'mail_pre_entry_date',
        'mail_confirmed_date',
        'mail_expired_date',
        'mail_call_date',
        'mail_score_date',
        'mail_withdrawal_date',
        'date_of_birth',
        'enrolment_exam',
        'exam_date_from',
        'exam_date_to',
        'changing_exam_send_date'
    ];

    const YES = 1;
    const NO = 2;
    const WORD_OF_MONTH = 1;
    const UNIVERSITY = 2;
    const WEB = 3;

    const ALL_STUDENTS = 0;
    const POLYTECHNIC_STUDENT = 1;
    const OTHER_UNIVERSITY = 2;
    const COMPANY = 3;
    const UNIVERSITY_PRIVATE = 4;

    const CONFIRMED = 1;
    const NOT_CONFIRMED = 2;
    const EXPIRED_NOT_SENT = 1;
    const EXPIRED_SENT = 2;

    const SENT = 1;

    const MAILED = 1;

    const NEW_S = 1;

    /**
     * Belongs to exam
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    /**
     *
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function Session()
    {
        return $this->BelongsTo(Session::class);
    }

    /**
     * Check if student is new object (not saves)
     *
     * @return bool
     */
    public function isNew()
    {
        if(isset($this->is_new)) {
            if($this->is_new) {
                return true;
            }
        }
        elseif($this->id == null) {
            return true;
        }
        else {
            return false;
        }
    }

    /**
     * Get city
     *
     * @return mixed
     */
    public function city()
    {
        return city($this->city);
    }

    /**
     * Get university
     *
     * @return mixed
     */
    public function university()
    {
        $university = config('universities.' . $this->university);
        return $university;
    }

    /**
     * Get school
     *
     * @return mixed
     */
    public function school()
    {
        $school = config('schools.' . $this->scool);
        return $school;
    }

    /**
     * Create excel file from students
     *
     * @param $fileName
     * @param $header
     * @param $body
     */
    public function excel($fileName, $header, $body)
    {
        $excel = new GenerateExcel();
        $excel->create($fileName, $header, $body);
    }

    public function firstEmail()
    {
        if(count($this->emails)) {
            return $this->emails[0];
        }
        else {
            return '';
        }
    }

    public function lastInvoice()
    {
        $invoice = new Invoice;
        return $invoice->lastStudentInvoice($this->id);
    }

    public function isStudent()
    {
        switch($this->university_code) {
            case self::POLYTECHNIC_STUDENT:
                return true;
            case self::OTHER_UNIVERSITY:
                return true;
            case self::COMPANY:
                return false;
        }

        return null;
    }

    public function isCompany()
    {
        if(false === $this->isStudent()) {
            return true;
        }
        if(true === $this->isStudent()) {
            return false;
        }

        return null;
    }

    public function exams()
    {
        return $this->belongsToMany(Exam::class);
    }

    public function paymentTypeChecked($typeId)
    {
        if($this->isNew()) {
            $typesArr = old('payment_type');
        }
        else {
            $typesArr = json_decode($this->payment_type);
        }

        if(is_array($typesArr)) {
            foreach($typesArr as $key => $value) {
                if($value == $typeId) {
                    return 'checked="checked"';
                }
            }
        }

        return '';
    }

    /**
     * Last user who have created the student
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function userCreated()
    {
        return $this->belongsTo(User::class, 'created_user_id', 'id');
    }

    /**
     * Last user who have updated the student
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function userUpdated()
    {
        return $this->belongsTo(User::class, 'updated_user_id', 'id');
    }

    /**
     * Get resident_in as array with cities ids
     *
     * @return array
     */
    public function residentInArr()
    {
        return explode(',', $this->resident_in);
    }

    /**
     * Get expired, not confirmed and not notified students
     *
     * @param $expiredMailTimes
     * @return \app\Student
     */
    public function getExpiredNotConfirmedAndNotNotifiedStudents($expiredMailTimes)
    {
        return Student::
        where(function ($query) {
            $query->where('confirmed', '=', self::NOT_CONFIRMED)
                ->orWhereNull('confirmed');
        })
            ->whereExpiredSent(self::EXPIRED_NOT_SENT)
            ->where('created_at', '<=', Carbon::now()
                ->subDays($expiredMailTimes->days)
                ->subHours($expiredMailTimes->hours)
                ->subMinutes($expiredMailTimes->minutes)
                ->toDateTimeString())
            ->get();
    }
}
