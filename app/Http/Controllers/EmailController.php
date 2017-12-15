<?php

namespace App\Http\Controllers;

use App\Attachment;
use App\Email;
use App\Http\Requests\EmailRequest;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function index()
    {
        $emails = Email::get();

        return view('email.index')->withEmails($emails);
    }

    public function create()
    {
        $email = new Email;
        $autos = config('email_templates.auto');
        $variables = config('email_templates.dynamic_variables');

        return view('email.edit', [
            'autos' => $autos,
            'template' => $email,
            'variables' => $variables
        ]);
    }

    public function store(EmailRequest $request)
    {
        if($this->uniqueAutoTemplateExists($request)) {
            return redirect()->back()->withErr('This automatic template already exists for this type of email');
        }

        if($this->uniqueTemplateExists($request)) {
            return redirect()->back()->withErr('This template already exists');
        }

        $email = new Email($request->all());
        $email->save();
        $email->attach($request->file('attachment'));

        return redirect()->route('email.edit', $email->id);
    }

    public function edit(Email $email)
    {
        $variables = config('email_templates.dynamic_variables');

        return view('email.edit', [
            'template' => $email,
            'variables' => $variables,
        ]);
    }

    public function update(Email $email, EmailRequest $request)
    {
        if($this->uniqueAutoTemplateExists($request, $email->id)) {
            return redirect()->back()->withErr('This automatic template already exists for this type of email');
        }

        if($this->uniqueTemplateExists($request, $email->id)) {
            return redirect()->back()->withErr('This template already exists');
        }

        $email->attach($request->file('attachment'));
        $email->update($request->all());

        return redirect()->route('email.edit', $email->id);
    }

    public function destroy(Email $email)
    {
        $email->delete();

        return redirect()->back();
    }

    /**
     * Check for unique automatic template for this type of email
     *
     * @param Request $request
     * @param null $existID
     * @return bool
     */
    private function uniqueAutoTemplateExists(Request $request, $existID = null)
    {
        if((int) $request->type === Email::PRE_ENTRY_AUTO) {

            $exists = Email::whereType(Email::PRE_ENTRY_AUTO)->first();
        }
        if((int) $request->type === Email::PRE_ENTRY_EXPIRED_AUTO) {

            $exists = Email::whereType(Email::PRE_ENTRY_EXPIRED_AUTO)->first();
        }
        if(isset($exists)) {
            if($exists) {
                if($exists->id !== $existID) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Check for unique TAN, TAT, TAS, FTS templates
     *
     * @param Request $request
     * @param $existID
     * @return bool
     */
    public function uniqueTemplateExists(Request $request, $existID = null)
    {
        if ( (int) $request->type === Email::TAN
          || (int) $request->type === Email::TAT
          || (int) $request->type === Email::TAS
          || (int) $request->type === Email::FTS ) {

            $exists = Email::whereType($request->type)->first();
        }

        if(isset($exists)) {
            if($exists->id !== $existID) {
                return true;
            }
        }

        return false;
    }
}
