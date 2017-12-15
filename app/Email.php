<?php

namespace App;

use App\Classes\FilterContent;
use App\Classes\SendEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class Email extends Model
{
    protected $fillable = [
        'name',
        'body',
        'type',
        'auto',
        'user_type',
        'attach_name'
    ];

    const PRE_ENTRY = 1;
    const PRE_ENTRY_AUTO = 11;
    const ENTRY_CONFIRMED = 2;
    const PRE_ENTRY_EXPIRED = 3;
    const PRE_ENTRY_EXPIRED_AUTO = 12;
    const CALL = 4;
    const SCORE = 5;
    const WITHDRAWAL = 6;
    const TAN = 7;
    const TAT = 8;
    const TAS = 9;
    const FTS = 10;
    const CHANGING_EXAM_DATE = 13;

    const REFORMAT_DATE = 'date';
    const REFORMAT_CONFIG = 'config';
    const REFORMAT_CONFIG_MULTI = 'config_multi';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function attachments()
    {
        return $this->hasMany(Attachment::class, 'template_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pdfAttachments()
    {
        return $this->hasMany(PdfAttachment::class);
    }

    /**
     * @param $type
     * @return mixed
     */
    public static function getByType($type)
    {
        return Email::whereType($type)->whereNotIn('type', [ self::PRE_ENTRY_AUTO, self::PRE_ENTRY_EXPIRED_AUTO ])->get();
    }

    /**
     * @return mixed
     */
    public static function getAllNonAuto()
    {
        return Email::whereNotIn('type', [ self::PRE_ENTRY_AUTO, self::PRE_ENTRY_EXPIRED_AUTO ])->get();
    }

    /**
     * Filter email body with dynamic variables
     *
     * @param $student
     */
    public function filterBodyVariables(Student $student)
    {
        $this->body = $this->filterContent($this->body, $student);
    }

    public function filterNameVariables(Student $student)
    {
        $this->name = $this->filterContent($this->name, $student);
    }

    public function filterContent($content, Student $student)
    {
        $variables = config('email_templates.dynamic_variables');
        $student = $student->toArray();
        $filterArray = new FilterContent($variables, $student, $content);

        return  $filterArray->filter();
    }

    /**
     * Attach file
     *
     * @param UploadedFile $file
     */
    public function attach(UploadedFile $file = null)
    {
        if($file) {
            $fileName = $file->getClientOriginalName();
            $file->move(base_path('logs'), $fileName);
            $attachment = new Attachment([
                'template_id' => $this->id,
                'path'        => 'logs/' . $fileName,
                'name'        => $fileName
            ]);
            $attachment->save();
        }
    }

    /**
     * Send email
     *
     * @param $template
     * @param $email
     * @param $student
     */
    public function send($template, $email, Student $student)
    {
        $this->filterBodyVariables($student);
        $this->filterNameVariables($student);

        $pdfAttachments = $this->customPdfAttachments($student);

        $sendEmail = new SendEmail([
            'template_name'      => $template,
            'email'              => $email,
            'template_model'     => $this,
            'subject'            => $this->name,
            'custom_attachments' => $pdfAttachments,
            'const_attachments'  => $this->attachments
        ]);
        $sendEmail->send();
    }

    /**
     * Get custom attachments for these template type and student type
     *
     * @return null
     * @param Student $student (need only for custom attachments)
     */
    public function customPdfAttachments($student)
    {
        $customAttachments = $this
            ->pdfAttachments()
            ->where('user_type', $student->university_code)
            ->orWhere('user_type', Student::ALL_STUDENTS)
            ->where('email_id', $this->id)
            ->get();

        $variables = config('email_templates.dynamic_variables');
        $filterArray = new FilterContent($variables, $student->toArray());

        foreach ($customAttachments as $key => $attachment) {
            $filterArray->setSource($attachment->body);
            $customAttachments[$key]->body = $filterArray->filter();
            $filterArray->setSource($attachment->name);
            $customAttachments[$key]->name = $filterArray->filter();
        }

        return $customAttachments;
    }

    /**
     * Get automatic pre-entry email
     *
     * @return mixed
     */
    public function getAutomaticPreEntryTemplate()
    {
        return Email::
        whereType(self::PRE_ENTRY_AUTO)
            ->first();
    }

    /**
     * Get automatic expired template
     *
     * @return mixed
     */
    public function getAutoExpiredTemplate()
    {
        return Email::
        whereType(self::PRE_ENTRY_EXPIRED_AUTO)
            ->first();
    }

    public function pdfsStringList()
    {
        $names = [];
        foreach ($this->pdfAttachments as $pdf) {
            $names[] = $pdf->name;
        }

        return implode($names,', ');
    }

    public function attachesStringList()
    {
        $names = [];
        foreach ($this->attachments as $pdf) {
            $names[] = $pdf->name;
        }

        return implode($names,', ');
    }

    public function getChangingExamDateTemplate()
    {
        return $this->whereType(self::CHANGING_EXAM_DATE)->first();
    }
}
