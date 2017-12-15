<?php

namespace App\Classes;

use App\Attachment;
use App\Email;
use Illuminate\Support\Facades\Mail;

class SendEmail
{
    private $templateName;
    private $templateModel;
    private $customAttachments;
    private $constAttachments;
    private $email;
    private $subject;

    public function __construct(array $settings)
    {
        $this->templateName = $settings['template_name'];
        $this->customAttachments = $settings['custom_attachments'] ? $settings['custom_attachments'] : [];
        $this->constAttachments = isset($settings['const_attachments']) ? $settings['const_attachments'] : [];
        $this->templateModel = $settings['template_model'];
        $this->email = $settings['email'];
        $this->subject = $settings['subject'];
    }

    public function send()
    {
        Mail::send('emails.' . $this->templateName, ['email' => $this->templateModel], function ($message) {

            $message
                ->to($this->email)
                ->subject($this->subject);

            foreach($this->customAttachments as $customAttachment) {
                $pdf = \PDF::loadView('emails.dynamic_pdf', [
                    'pdfTemplate' => $customAttachment
                ]);
                $message->attachData($pdf->output(), $customAttachment->name . '.pdf');
            }

            foreach($this->constAttachments as $constAttachment) {
                $message->attach(base_path($constAttachment->path));
            }
        });
    }
}
