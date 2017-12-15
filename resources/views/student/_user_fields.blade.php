
<tr>
    <td
            align="center"
            colspan="3"
            bgcolor="#F7F7F7"
            class="size">
        <p>
            @if(!$student->isNew() && $student->created_at)
                <span class="size1">
                                <span class="ricerca">{{ $student->name }} {{ $student->surname }} - Exams date del {{ localFormatOnlyDate($student->enrolment_exam) }}
                                </span>
                            </span>
                <span class="size1">- record created </span>
                <span class="size1">il {{ $student->created_at->timezone('GMT+2')->format('m/d/Y') }} - {{ $student->created_at->timezone('GMT+2')->format('H:i:s') }}- edited by &quot;user&quot; il {{ $student->updated_at->timezone('GMT+2')->format('m/d/Y') }} - @ {{ $student->updated_at->timezone('GMT+2')->format('H:i:s') }} <strong class="size">&nbsp; &nbsp; &nbsp;</strong></span>
                <span class="testobianco">
                                <strong class="size"> &nbsp;
                                </strong></span>
                <br />
                @if($student->session)
                    <span>Session: {{ $student->session->description }}</span>
                @endif
            @else
                <span class="size1">Create new record </span>
                <br />
                @if($student->session)
                    <span>Session: {{ $student->session->description }}</span>
                @endif
            @endif
            <span class="choice">
                                <strong class="size">
                                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                    <img src="/image/traffic-lights1.png"
                                         alt="" width="55"
                                         height="20"/>
                                </strong>
                            </span>
        </p>
    </td>
    <td align="center" colspan="2" bgcolor="#96B524">
        <div align="right"><span class="size">
                    <input type="submit" value="Save" class="button"/>
                     </span></div>
    </td>
</tr>
<tr>
    <td align="center" colspan="5" bgcolor="#999999" class="size">&nbsp;</td>
</tr>
<tr>
    <td align="center" width="16%" bgcolor="#ECECECECECEC"><span class="ricerca">Name</span><span class="ricerca">
                    <input type="text" name="name" id="name" class="edit" value="{{ old('name') ?: $student->name }}"/>
            @if ($errors->has('name'))
                <span class="help-block form-error">
                                {{ $errors->first('name') }}
                            </span>
            @endif
                    </span>
    </td>
    <td align="center" width="20%" bgcolor="#ECECECECECEC"><span class="ricerca">Surname</span><span class="ricerca">
                    <input type="text" name="surname" id="surname" class="edit" value="{{ old('surname') ?: $student->surname }}"/>
            @if ($errors->has('surname'))
                <span class="help-block form-error">
                                {{ $errors->first('surname') }}
                            </span>
            @endif

                    </span>
    </td>
    <td align="center" width="22%" bgcolor="#ECECECECECEC"><span style="text-align: center"><strong><span
                        class="size"><span class="ricerca">FISCAL CODE - VAT<br/>
                    <input placeholder="BRGFLB50H11G141X" type="text" name="fiscal_code" class="edit" value="{{ old('fiscal_code') ?: $student->fiscal_code }}" id="fiscal_code"/>
                        @if ($errors->has('fiscal_code'))
                            <span class="help-block form-error">
                                        {{ $errors->first('fiscal_code') }}
                                        </span>
                        @endif

                     </span></span>
                            <br />
                            <span class="ricerca">
                    <input type="text" name="vat" class="edit" value="{{ old('vat') ?: $student->vat }}"/>
                    </span></strong></span>
    </td>

    <td align="center" width="18%" bgcolor="#ECECECECECEC"><span class="ricerca">Student Personal Code</span> <span
                class="ricerca">
                    <input type="text" name="personal_code" class="edit" value="{{ old('personal_code') ?: $student->personal_code }}"/>
            @if ($errors->has('personal_code'))
                <span class="help-block form-error">
                                {{ $errors->first('personal_code') }}
                            </span>
            @endif
            <br/>
                    </span>
    </td>

    <td align="center" width="19%" bgcolor="#ECECECECECEC"><span class="ricerca">University code<br/>
                    </span> <span class="ricerca">
            <select name="university_code" class="combo">
                @foreach(config('university_codes') as $id => $code)
                    <option
                            @if($student->university_code == $id || old('university_code') == $id)
                                selected="selected"
                            @endif
                            value="{{ $id }}">{{ $code }}</option>
                @endforeach
            </select>
                    </span>
    </td>
</tr>

<tr>
    <td align="center"><span class="ricerca">Born in</span> <span class="ricerca">
                    <input type="text" name="born_in" class="edit" value="{{ old('born_in') ?: $student->born_in }}"/>
            @if ($errors->has('born_in'))
                <span class="help-block form-error">
                                {{ $errors->first('born_in') }}
                            </span>
            @endif
                    </span>
    </td>

    <td align="center" class="ricerca">City
        <!--{{--<input name="city" id="city" class="edit" value="{{ old('city') ?: $student->city }}">--}}-->
        <select name="city" id="city" class="combo">
            @foreach(config('cities') as $key => $city)
                <option
                        @if(!$student->isNew())
                        @if($student->city == $key)
                        selected="selected"
                        @endif
                        @endif
                        value="{{ $key }}">{{ $city }}</option>
            @endforeach
        </select>
    </td>

    <td align="center">
                    <span class="ricerca">Date of birth:
                        <input class="edit" type="date" name="date_of_birth" value="{{ old('date_of_birth') ? localDate(old('date_of_birth')) : localDate($student->date_of_birth) }}">
                        @if ($errors->has('date_of_birth'))
                            <span class="help-block form-error">
                                {{ $errors->first('date_of_birth') }}
                            </span>
                        @endif

                    </span>
    </td>

    <td align="center"><span class="ricerca">Nation</span>
        <br />
        <span class="ricerca">
            <select name="nation" id="nation" class="combo" onchange="">
                @foreach(config('countries') as $id => $country)
                    <option
                            @if(!$student->isNew())
                            @if($student->nation == $id)
                            selected="selected"
                            @endif
                            @endif
                            value="{{ $id }}">{{ $country }}</option>
                @endforeach
            </select>
          </span></td>
    <td align="center"><span class="ricerca">Resident in (for invoice)<br/>
            <select name="resident_in[]" id="resident_in" multiple>
                @foreach(config('cities') as $id => $city)
                    <option
                            value="{{ $id }}"
                                @if(!$student->isNew())
                                    @foreach($student->residentInArr() as $key => $selectedCityId)
                                        @if($selectedCityId == $id)
                                            selected="selected"
                                        @elseif($id == $student->city)
                                            selected="selected"
                                        @endif
                                    @endforeach
                                @else
                                    @foreach(is_array(old('resident_in')) ? old('resident_in') : [] as $key => $selectedCityId)
                                        @if($id == $selectedCityId)
                                            selected="selected"
                                        @endif
                                    @endforeach
                                @endif
                    >{{ $city }}
                    </option>
                @endforeach
            </select>
            @if ($errors->has('resident_in'))
                <span class="help-block form-error">
                   {{ $errors->first('resident_in') }}
                </span>
            @endif
          </span>
    </td>
</tr>
<tr>
    <td align="center" bgcolor="#ECECEC" class="ricerca">Address
        <input name="address" class="edit" type="text" value="{{ old('address') ?: $student->address }}"/>
        @if ($errors->has('address'))
            <span class="help-block form-error">
                            {{ $errors->first('address') }}
                        </span>
        @endif
    </td>

    <td align="center" bgcolor="#ECECEC"><p><span class="ricerca">Shipping Address
                <input class="edit" name="shipping_address" type="text" value="{{ old('shipping_address') ?: $student->shipping_address }}"/>
                @if ($errors->has('shipping_address'))
                    <span class="help-block form-error">
                            {{ $errors->first('shipping_address') }}
                        </span>
                @endif
          </span></p>
    </td>
    <td align="center" bgcolor="#ECECEC"><span class="ricerca">Street</span>
        <span class="ricerca">
            <input type="text" name="street" id="street" class="edit" value="{{ old('street') ?: $student->street }}"/> n°</span> <span class="ricerca">
            @if ($errors->has('street'))
                <span class="help-block form-error">
                   {{ $errors->first('street') }}
                </span>
            @endif
            <input size="3" type="text" name="number" id="number" class="edit" value="{{ old('number') ?: $student->number }}"/>
                @if ($errors->has('number'))
                    <span class="help-block form-error">
                            {{ $errors->first('number') }}
                        </span>
                @endif
                    </span>
    </td>
    <td align="center" bgcolor="#ECECEC" class="ricerca">Postal Code
        <input size="6" type="text" name="cap" id="cap" class="edit" value="{{ old('cap') ?: $student->cap }}"/>
        @if ($errors->has('cap'))
            <span class="help-block form-error">
                {{ $errors->first('cap') }}
            </span>
        @endif
    </td>
    <td align="center" bgcolor="#ECECEC"><span class="ricerca">Province</span> <span class="ricerca">
            <select name="province" id="province" class="combo">
                @foreach(config('provinces') as $id => $province)
                    <option
                            @if(!$student->isNew())
                            @if($student->province == $id)
                            selected="selected"
                            @endif
                            @endif
                            value="{{ $id }}">{{ $province }}</option>
                @endforeach
            </select>
          </span></td>
</tr>
<tr>
    <td align="center" class="ricerca">Phone
        <input type="text" name="phone" class="edit" value="{{ old('phone') ?: $student->phone }}"/>
        @if ($errors->has('phone'))
            <span class="help-block form-error">
                                {{ $errors->first('phone') }}
                            </span>
        @endif
    </td>

    <td align="center" class="ricerca">
        <div style="display: inline-block;">
            <label>e-mail</label>
        </div>
        <div style="display: inline-block;">
            <input style="width:100%" type="text" name="email" id="email" class="edit" value="{{ old('email') ?: $student->email }}"/>
        </div>
        @if ($errors->has('email'))
            <span class="help-block form-error">
                            {{ $errors->first('email') }}
                        </span>
        @endif
    </td>

    <td align="center">
                    <span class="ricerca">University
                        <select name="university" id="university" class="combo">
                            @foreach(config('universities') as $id => $university)
                                <option
                                        @if(!$student->isNew())
                                        @if($student->university == $id)
                                        selected="selected"
                                        @endif
                                        @endif
                                        value="{{ $id }}">{{ $university }}</option>
                            @endforeach
                        </select>
                    </span>
    </td>

    <td align="center"><span class="ricerca">School
              <select name="school" id="school" class="combo">
                  @foreach(config('schools') as $id => $school)
                      <option
                              @if(!$student->isNew())
                              @if($student->school == $id)
                              selected="selected"
                              @endif
                              @endif
                              value="{{ $id }}">{{ $school }}</option>
                  @endforeach
              </select>
          </span>
    </td>

    <td align="center">
        <div style="display: inline-block;">
            <span class="ricerca">Matricola </span>
        </div>
        <div style="display: inline-block;">
            <input name="matricola" id="matricola" class="edit" value="{{ old('matricola') ?: $student->matricola }}">
            @if ($errors->has('matricola'))
                <span class="help-block form-error">
                            {{ $errors->first('matricola') }}
                        </span>
            @endif
        </div>
    </td>

</tr>
<tr>
    <td align="center" class="ricerca">Enrolment Exam
        <input type="date" class="edit" placeholder="dd/mm/yyyy" name="enrolment_exam" id="enrolment_exam" value="{{ old('enrolment_exam') ? localDate(old('enrolment_exam')) :  localDate($student->enrolment_exam) }}"/>
        @if ($errors->has('enrolment_exam'))
            <span class="help-block form-error">
                            {{ $errors->first('enrolment_exam') }}
                        </span>
        @endif
    </td>
    <td align="center" rowspan="2">
        <div><strong><span class="ricerca">Examination already taken?</span></strong> <span
                    style="text-align: center"><span class="choice">
                                <br />
                                Yes
                                <input
                                        @if($student->exam_already_taken == \App\Student::YES)
                                        checked="checked"
                                        @endif
                                        type="radio" name="exam_already_taken" id="exam_already_taken" value="{{ \App\Student::YES }}"/>
                            </span>
                            <span class="choice">No
                                <input
                                        @if($student->exam_already_taken == \App\Student::NO)
                                        checked="checked"
                                        @endif
                                        type="radio" name="exam_already_taken" id="exam_already_taken" value="{{ \App\Student::NO }}"/>
                            </span>
                        </span>
            <br/>
            <span style="text-align: center"><span class="choice"> </span></span></div>
        <span style="text-align: center"><span class="choice">
                    <label for="città13"></label>
                    <div align="center">
                        <input name="eat_city" type="text" id="eat_school" value="{{ old('eat_city') ?: $student->eat_city }}"/>
                        @if ($errors->has('eat_city'))
                            <span class="help-block form-error">
                            {{ $errors->first('eat_city') }}
                        </span>
                        @endif
                        <br />
                        <input name="eat_school" type="text" id="eat_school" value="{{ old('eat_school') ?: $student->eat_school }}"/>
                        @if ($errors->has('eat_school'))
                            <span class="help-block form-error">
                            {{ $errors->first('eat_school') }}
                        </span>
                        @endif
                        <br />
                        <input name="eat_date" type="text" id="eat_date" value="{{ old('eat_date') ?: $student->eat_date }}"/>
                        @if ($errors->has('eat_date'))
                            <span class="help-block form-error">
                            {{ $errors->first('eat_date') }}
                        </span>
                        @endif
                    </div>
                    </span></span>
    </td>
    <td colspan="3" rowspan="2" align="center"  class="ricerca"><strong>Examination fee + Courses + Book</strong><br/>
        <select multiple name="exam_id[]" id="testo2" class="exam">
            @foreach($exams as $exam)
                <option value="{{ $exam->id }}"
                    @if(!$student->isNew())
                        @foreach($student->exams as $studentExam)
                            @if($exam->id == $studentExam->id)
                                selected="selected"
                            @endif
                        @endforeach
                    @else
                        @foreach(is_array(old('exam_id')) ? old('exam_id') : [] as $key => $selectedExamId)
                            @if($exam->id == $selectedExamId)
                                selected="selected"
                            @endif
                        @endforeach
                    @endif
                >{{ $exam->title() }}</option>
            @endforeach
        </select>
    </td>

</tr>

<tr>
    <td align="center" class="ricerca">Signature<br>
        <img width="150" src="{{ $student->image }}"/>
    </td>
</tr>

<tr>
    <td align="center" bgcolor="#ECECEC">
        <div align="center"><span class="ricerca">Changing exams date</span><br/>
            <span class="ricerca">
            from
            <input placeholder="gg/mm/aaaa" name="exam_date_from" type="date" id="exam_date_from" value="{{ old('exam_date_from') ? localDate(old('exam_date_from')) : localDate($student->enrolment_exam) }}"/>
                @if ($errors->has('exam_date_from'))
                    <span class="help-block form-error">
                            {{ $errors->first('exam_date_from') }}
                    </span>
                @endif
                to
            <select name="exam_date_to" id="exam_date_to" class="combo">
                <option value="">Exam date</option>
                @foreach($sessions as $session)
                    <option
                            @if(localDate($session->date) == localDate($student->exam_date_to) ||
                                localDate($session->date) == localDate(old('exam_date_to')))
                            selected="selected"
                            @endif
                            value="{{ localDate($session->date) }}">{{ localFormatOnlyDate($session->date) }}
                    </option>
                @endforeach
            </select>
                @if ($errors->has('exam_date_to'))
                    <span class="help-block form-error">
                        {{ $errors->first('exam_date_to') }}
                    </span>
                @endif
          </span><span style="text-align: center">
          &nbsp;
          <input type="submit" name="invia9" id="invia" value="send"/>
                @if($student->changing_exam_send_date)
                    <img src="/image/pallino-verde.png" alt="" width="10" height="10">
                    <span>{{ $student->changing_exam_send_date->timezone('GMT+2')->format("d/m/Y H:i") }}</span>
                @endif
          </span></div>
    </td>
    <td align="center" bgcolor="#ECECEC" class="ricerca">
        <div align="center">send TAN code <span class="size"><span class="choice"><span
                            class="size">31</span></span></span>:
            <br/>
            <input name="tan" type="text" class="codes-font edit" value="{{ old('tan') ?: $student->tan ?: 'TAN' }}"/>
            <span style="text-align: center">
              <input type="submit" id="tan" class="send_code" value="Invia"/>
                @if($student->tan_date)
                    <img src="/image/pallino-verde.png" alt="" width="10" height="10">
                    <span>{{ $student->tan_date->timezone('GMT+2')->format("d/m/Y H:i") }}</span>
                @endif
            </span></div>
    </td>
    <td align="center" bgcolor="#ECECEC" class="ricerca">
        <div align="center">Send TAT code<span class="choice"><span class="size">10</span></span>:<br/>
            <input name="tat" type="text" class="codes-font edit" value="{{ old('tat') ?: $student->tat ?: 'TAT' }}"/>
            <span style="text-align: center">
              <input type="submit" id="tat" class="send_code" value="Invia"/>
                @if($student->tat_date)
                    <img src="/image/pallino-verde.png" alt="" width="10" height="10">
                    <span>{{ $student->tat_date->timezone('GMT+2')->format("d/m/Y H:i") }}</span>
                @endif
          </span></div>
    </td>
    <td align="center" bgcolor="#ECECEC">
        <div align="center"><span class="ricerca">Send  TAS code <span class="choice"><span
                            class="size">5</span></span>:
            <br/>
            <input name="tas" type="text" class="codes-font edit" value="{{ old('tas') ?: $student->tas ?: 'TAS' }}"/>
            <span style="text-align: center">
              <input type="submit" id="tas" class="send_code" value="Invia"/>
                @if($student->tas_date)
                    <img src="/image/pallino-verde.png" alt="" width="10" height="10">
                    <span>{{ $student->tas_date->timezone('GMT+2')->format("d/m/Y H:i") }}</span>
                @endif
          </span></span></div>
    </td>
    <td align="center" bgcolor="#ECECEC">
        <div align="center"><span class="ricerca">Send free FTS code:
                <br/>
              <input name="fts" type="text" class="codes-font edit" value="{{ old('fts') ?: $student->fts ?: 'FTS' }}"/>
            <span style="text-align: center">
             <input type="submit" id="fts" class="send_code" value="Invia"/>
                @if($student->fts_date)
                    <img src="/image/pallino-verde.png" alt="" width="10" height="10">
                    <span>{{ $student->fts_date->timezone('GMT+2')->format("d/m/Y H:i") }}</span>
                @endif
            </span></span></div>
    </td>
</tr>

<tr>
    <td align="center" colspan="5" bgcolor="#999999">
        <div align="center"></div>
    </td>
</tr>

<tr>

    <td align="center" class="ricerca">How did you know us<br/>
        <div style="text-align: center"><span class="choice">Word of mouth
                    <input
                            @if($student->know_us == \App\Student::WORD_OF_MONTH)
                            checked="checked"
                            @endif
                            type="radio" name="know_us" id="know_us" value="{{ \App\Student::WORD_OF_MONTH }}"/></span>
            <br />
            <span class="choice">University
                    <input
                            @if($student->know_us == \App\Student::UNIVERSITY)
                            checked="checked"
                            @endif
                            type="radio" name="know_us" id="know_us" value="{{ \App\Student::UNIVERSITY }}"/>
                    <br />
                    Web
                    <input
                            @if($student->know_us == \App\Student::WEB)
                            checked="checked"
                            @endif
                            type="radio" name="know_us" id="know_us" value="{{ \App\Student::WEB }}"/>
                    </span></div>
    </td>

    <td align="center">
        <div align="center">
            <strong><span class="size1">SEND MAIL pre-entry</span></strong>
            <img id="mail_pre_entry"
                 @if(!($student->mail_pre_entry_date || old('mail_pre_entry_date')))
                 style="display: none;"
                 @endif
                 src="/image/pallino-verde.png"
                 alt=""
                 width="10"
                 height="10"/>
            <span id="mail_pre_entry">{{ old('mail_pre_entry_date') ?: localFormatDate($student->mail_pre_entry_date) }}</span><br/>
            <input class="hidden-input"
                   id="mail_pre_entry"
                   name="mail_pre_entry_date"
                   type="hidden"
                   value="{{ old('mail_pre_entry_date') ?: $student->mail_pre_entry_date }}" ><br/>
            <span style="text-align: center">
                            <select name="mail_pre_entry"
                                    class="send-email-select"
                                    id="mail_pre_entry">
                                @foreach(\App\Email::getByType(\App\Email::PRE_ENTRY) as $email)
                                    <option
                                            value="{{ $email->id }}"
                                            @if($email->id == $student->mail_pre_entry || $email->id == old('mail_pre_entry'))
                                            selected="selected"
                                            @endif
                                    >{{ $email->name }}</option>
                                @endforeach
                            </select>
                            <a onclick="sendEmail(this); return false;"
                               id="mail_pre_entry"
                               class="send-email-input mail-button"
                               email="{{ old('mail_pre_entry') ?: $student->mail_pre_entry ?: $student->firstEmail() }}" >Invia
                            </a>
                        </span>
        </div>
    </td>

    <style>
        .mail-button {
            margin-left: 5px;
            padding: 2px;
            border: 1px solid blue;
            background-color: cornflowerblue;
            cursor: pointer;
            border-radius: 5px;
            color: white;
        }
    </style>

    <td align="center">
        <div align="center">
            <strong><span class="size1">SEND MAIL entry confirmed</span></strong>
            <img id="mail_confirmed"
                 @if(!($student->mail_confirmed_date || old('mail_confirmed_date')))
                 style="display: none;"
                 @endif
                 src="/image/pallino-verde.png"
                 alt=""
                 width="10"
                 height="10"/>
            <span id="mail_confirmed">{{ old('mail_confirmed_date') ?: localFormatDate($student->mail_confirmed_date) }}</span><br/>
            <input class="hidden-input"
                   id="mail_confirmed"
                   name="mail_confirmed_date"
                   type="hidden"
                   value="{{ old('mail_confirmed_date') ?: $student->mail_confirmed_date }}" ><br/>
            <span style="text-align: center">
                            <select name="mail_confirmed"
                                    class="send-email-select"
                                    id="mail_confirmed">
                                @foreach(\App\Email::getByType(\App\Email::ENTRY_CONFIRMED) as $email)
                                    <option
                                            value="{{ $email->id }}"
                                            @if($email->id == $student->mail_confirmed || $email->id == old('mail_confirmed'))
                                            selected="selected"
                                            @endif
                                    >{{ $email->name }}</option>
                                @endforeach
                            </select>
                            <a onclick="sendEmail(this); return false;"
                               id="mail_confirmed"
                               class="send-email-input mail-button"
                               email="{{ old('mail_confirmed') ?: $student->mail_confirmed ?: $student->firstEmail()  }}" >Invia
                            </a>
                        </span>
        </div>
    </td>






    <td align="center">
        <div align="center">
            <strong><span class="size1">SEND MAIL pre-entry expired</span></strong>
            <img id="mail_expired"
                 @if(!($student->mail_expired_date || old('mail_expired_date')))
                 style="display: none;"
                 @endif
                 src="/image/pallino-verde.png"
                 alt=""
                 width="10"
                 height="10"/>
            <span id="mail_expired">{{ old('mail_expired_date') ?: localFormatDate($student->mail_expired_date) }}</span><br/>
            <input class="hidden-input"
                   id="mail_expired"
                   name="mail_expired_date"
                   type="hidden"
                   value="{{ old('mail_expired_date') ?: $student->mail_expired_date }}" ><br/>
            <span style="text-align: center">
                            <select name="mail_expired"
                                    class="send-email-select"
                                    id="mail_expired">
                                @foreach(\App\Email::getByType(\App\Email::PRE_ENTRY_EXPIRED) as $email)
                                    <option
                                            value="{{ $email->id }}"
                                            @if($email->id == $student->mail_expired || $email->id == old('mail_expired'))
                                            selected="selected"
                                            @endif
                                    >{{ $email->name }}</option>
                                @endforeach
                            </select>
                            <a onclick="sendEmail(this); return false;"
                               id="mail_expired"
                               class="send-email-input mail-button"
                               email="{{ old('mail_expired') ?: $student->mail_expired ?: $student->firstEmail()  }}" >Invia
                            </a>
                        </span>
        </div>
    </td>


    <td align="center" rowspan="1" bgcolor="#ECECECECECEC"><span style="text-align: center"><strong><span
                        class="size1">Note</span></strong></span>:<br/>
        <textarea name="note" cols="60" rows="3" id="note">{{ old('note') ?: $student->note }}</textarea>
    </td>
</tr>

<tr>
    <td align="center">
        <div align="center"><strong><span class="size1"><img src="/image/pallino-verde.png" alt=""
                                                             width="10" height="10"/> Confirmed:
                                <br />
                                <span style="text-align: center">
                                    <span class="choice">yes
                                        <input
                                                @if($student->confirmed == \App\Student::YES)
                                                checked="checked"
                                                @endif
                                                type="radio"
                                                name="confirmed"
                                                id="confirmed"
                                                value="{{ \App\Student::YES }}"/>
                                    </span>
                                    <span class="choice"> no
                                        <input
                                                @if($student->confirmed == \App\Student::NO)
                                                checked="checked"
                                                @endif
                                                type="radio"
                                                name="confirmed"
                                                id="confirmed"
                                                value="{{ \App\Student::NO }}"/>
                                    </span>
                                </span>
                            </span>
            </strong>
        </div>
        <label for="città3"></label>
    </td>

    <td align="center">
        <div align="center">
            <strong><span class="size1">SEND MAIL - call</span></strong>
            <img id="mail_call"
                 @if(!($student->mail_call_date || old('mail_call_date')))
                 style="display: none;"
                 @endif
                 src="/image/pallino-verde.png"
                 alt=""
                 width="10"
                 height="10"/>
            <span id="mail_call">{{ old('mail_call_date') ?: localFormatDate($student->mail_call_date) }}</span><br/>
            <input class="hidden-input"
                   id="mail_call"
                   name="mail_call_date"
                   type="hidden"
                   value="{{ old('mail_call_date') ?: $student->mail_call_date }}" ><br/>
            <span style="text-align: center">
                            <select name="mail_call"
                                    class="send-email-select"
                                    id="mail_call">
                                @foreach(\App\Email::getByType(\App\Email::CALL) as $email)
                                    <option
                                            value="{{ $email->id }}"
                                            @if($email->id == $student->mail_call || $email->id == old('mail_call'))
                                            selected="selected"
                                            @endif
                                    >{{ $email->name }}</option>
                                @endforeach
                            </select>
                            <a onclick="sendEmail(this); return false;"
                               id="mail_call"
                               class="send-email-input mail-button"
                               email="{{ old('mail_call') ?: $student->mail_call ?: $student->firstEmail()  }}" >Invia
                            </a>
                        </span>
        </div>
    </td>





    <td align="center">
        <div align="center">
            <strong><span class="size1">SEND score</span></strong>
            <img id="mail_score"
                 @if(!($student->mail_score_date || old('mail_score_date')))
                 style="display: none;"
                 @endif
                 src="/image/pallino-verde.png"
                 alt=""
                 width="10"
                 height="10"/>
            <span id="mail_score">{{ old('mail_score_date') ?: localFormatDate($student->mail_score_date) }}</span><br/>
            <input class="hidden-input"
                   id="mail_score"
                   name="mail_score_date"
                   type="hidden"
                   value="{{ old('mail_score_date') ?: $student->mail_score_date }}" ><br/>
            <span style="text-align: center">
                            <select name="mail_score"
                                    class="send-email-select"
                                    id="mail_score">
                                @foreach(\App\Email::getByType(\App\Email::SCORE) as $email)
                                    <option
                                            value="{{ $email->id }}"
                                            @if($email->id == $student->mail_score || $email->id == old('mail_score'))
                                            selected="selected"
                                            @endif
                                    >{{ $email->name }}</option>
                                @endforeach
                            </select>
                            <a onclick="sendEmail(this); return false;"
                               id="mail_score"
                               class="send-email-input mail-button"
                               email="{{ old('mail_score') ?: $student->mail_score ?: $student->firstEmail()  }}" >Invia
                            </a>
                        </span>
        </div>
    </td>





    <td align="center">
        <div align="center">
            <strong><span class="size1">SEND MAIL - withdrawal</span></strong>
            <img id="mail_withdrawal"
                 @if(!($student->mail_withdrawal_date || old('mail_withdrawal_date')))
                 style="display: none;"
                 @endif
                 src="/image/pallino-verde.png"
                 alt=""
                 width="10"
                 height="10"/>
            <span id="mail_withdrawal">{{ old('mail_withdrawal_date') ?: localFormatDate($student->mail_withdrawal_date) }}</span><br/>
            <input class="hidden-input"
                   id="mail_withdrawal"
                   name="mail_withdrawal_date"
                   type="hidden"
                   value="{{ old('mail_withdrawal_date') ?: $student->mail_withdrawal_date }}" ><br/>
            <span style="text-align: center">
                            <select name="mail_withdrawal"
                                    class="send-email-select"
                                    id="mail_withdrawal">
                                @foreach(\App\Email::getByType(\App\Email::WITHDRAWAL) as $email)
                                    <option
                                            value="{{ $email->id }}"
                                            @if($email->id == $student->mail_withdrawal || $email->id == old('mail_withdrawal'))
                                            selected="selected"
                                            @endif
                                    >{{ $email->name }}</option>
                                @endforeach
                            </select>
                            <a onclick="sendEmail(this); return false;"
                               id="mail_withdrawal"
                               class="send-email-input mail-button"
                               email="{{ old('mail_withdrawal') ?: $student->mail_withdrawal ?: $student->firstEmail()  }}" >Invia
                            </a>
                        </span>
        </div>
    </td>

    <td align="center" rowspan="1" bgcolor="#ECECECECECEC"><span style="text-align: center"><strong><span
                        class="size1">Scores</span></strong></span>:<br/>
        Listening: <input name="listening" id="listening" value="{{ old('listening') ?: $student->listening }}"><br>
        Reading: <input name="reading" id="reading" value="{{ old('reading') ?: $student->reading }}"><br>
        Total score: <input name="total_score" id="total_score" value="{{ old('total_score') ?: $student->total_score }}"><br>
    </td>

</tr>
<tr>
    <td align="center" colspan="5" bgcolor="#999999">&nbsp;</td>
</tr>
<tr>

    <td align="center" rowspan="2" bgcolor="#ECECECECECEC"><span class="ricerca">Summary: <br/>
          </span>
        <table width="100%" border="0" class="summary">
        </table>
    </td>

    <td align="center" colspan="1" rowspan="2" bgcolor="#ECECECECECEC">
        <div align="center">
            <span class="ricerca">Description course invoice</span><br/>
            <textarea name="description" id="description" cols="80" rows="5" id="teso">{{ old('description') ?: $student->description }}</textarea>
        </div>
    </td>

    <td align="center" colspan="1" rowspan="2" bgcolor="#ECECECECECEC">
        <div align="center">
            <span class="ricerca">Type of payment</span><br/>
            @foreach(config('payments.types') as $key => $paymentType)
                <label for="payment_type">{{ $paymentType }}</label> <input
                    {{ $student->paymentTypeChecked($key) }}
                    type="checkbox"
                    id="payment_type"
                    name="payment_type[]"
                    value="{{ $key }}"><br>
            @endforeach
        </div>
    </td>

    <td align="center" colspan="2" bgcolor="#ECECECECECEC"><span style="text-align: center"><strong><span class="size1">Memo DF</span></strong></span>
        <span class="choice" style="text-align: center">
            <input class="edit" name="memo_1" type="text" id="teso22" value="{{ old('memo_1') ?: $student->memo_1 }}"/>
            @if ($errors->has('memo_1'))
                <span class="help-block form-error">
                            {{ $errors->first('memo_1') }}
                </span>
            @endif
            <span class="ricerca">
                <input class="edit" name="memo_2" type="text" value="{{ old('memo_2') ?: $student->memo_2 }}"/>
                @if ($errors->has('memo_2'))
                    <span class="help-block form-error">
                        {{ $errors->first('memo_2') }}
                    </span>
                @endif
                <span class="size1">VOTE</span>
                   <input class="edit" name="vote" type="text" value="{{ old('vote') ?: $student->vote }}"/>
                    @if ($errors->has('vote'))
                        <span class="help-block form-error">
                            {{ $errors->first('vote') }}
                        </span>
                    @endif
                </span>
        </span>
    </td>
</tr>
<tr>
    <td align="center" height="28" bgcolor="#ECECECECECEC">
        <div align="center"><strong><span class="choice">Progressive number invoice  issued</span></strong><span
                    class="ricerca">
              <input type="text" id="invoice_number_1" name="invoice_number_1" class="edit" value="{{ old('invoice_number_1') ?: $student->invoice_number_1 }}"/>
                @if ($errors->has('invoice_number_1'))
                <span class="help-block form-error">
                            {{ $errors->first('invoice_number_1') }}
                </span>
                @endif
          </span><span class="ricerca">
          <input type="text" name="invoice_number_2" class="edit" value="{{ old('invoice_number_2') ?: $student->invoice_number_2 }}"/>
                @if ($errors->has('invoice_number_2'))
                    <span class="help-block form-error">
                            {{ $errors->first('invoice_number_2') }}
                    </span>
                @endif
          </span></div>
    </td>
    <td align="center" bgcolor="#ECECECECECEC">
        <div align="center"><strong><span class="size1">SEND invoice<br/>
            </span></strong><span style="text-align: center">
              <select name="testo" id="testo">
                  <option>Send Invoice</option>
                  <!--<option>Invoice n° 00 + Name and Surname</option>-->
              </select>
                <img {!! $student->lastInvoice() ?: 'style="display:none;"' !!} class="invoice_send" src="/image/pallino-verde.png" alt="" width="10" height="10">
                <span class="invoice_send">{{ $student->lastInvoice() ? localFormatDate($student->lastInvoice()->send_at) : '' }}</span>
              <br/>
                            <a onclick="sendInvoice(); return false;"
                               class="send-invoice mail-button"
                            >Sent
                            </a><span style="margin-left: 10px;" class="invoice-result"></span>
          </span></div>
    </td>
</tr>
