<?php

namespace App\Http\Controllers;

use App\Email;
use App\Http\Requests\EmailPdfAttachmentRequest;
use App\PdfAttachment;

class EmailPdfAttachmentController extends Controller
{
    public function create(Email $email, PdfAttachment $pdf)
    {
        return view('email.pdf.edit', [
            'emailTemplate' => $email,
            'template' => $pdf,
            'variables' => config('email_templates.dynamic_variables'),
            'userTypes' => config('email_templates.user_type'),
        ]);
    }

    public function store(Email $email, EmailPdfAttachmentRequest $request, PdfAttachment $pdf)
    {
        $email->pdfAttachments()->create($request->all());

        return redirect()->route('email.edit', $email->id)->withMsg('PDF attachment created.');
    }

    public function edit(PdfAttachment $pdf)
    {
        return view('email.pdf.edit', [
            'template' => $pdf,
            'emailTemplate' => $pdf->email,
            'variables' => config('email_templates.dynamic_variables'),
            'userTypes' => config('email_templates.user_type'),
        ]);
    }

    public function update(PdfAttachment $pdf, EmailPdfAttachmentRequest $request)
    {
        $pdf->update($request->all());

        return redirect()->route('email.edit', $pdf->email->id)->withMsg('PDF attachment updated.');
    }

    public function destroy(PdfAttachment $pdf)
    {
        $pdf->delete();

        return redirect()->back()->withMsg('PDF attachment deleted.');
    }
}
