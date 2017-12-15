@extends('layouts.showcase')

@section('title')
    Sessions
    @endsection

    @section('content')

        <style type="text/css">
            .session {
                margin: 30px;
                padding: 10px;
                background-color: #407bcc;
                color: white;
                text-align: left;
                font-size: 20px;
                cursor: pointer;
                max-width: 700px;
            }
            @media (min-width: 874px) {
                .session {
                    min-width: 500px;
                }
            }
            @media (max-width: 873px) and (min-width: 368px) {
                .session {
                    min-width: 300px;
                }
            }
            .description {
                display: inline-block;
            }
            .contact {
                width:10%;
                display: inline-block;
            }
            .button-contact {
                background-color: #407bcc;
                color: white;
                margin: 10px;
                padding: 10px;
                font-size: 18px;
                cursor: pointer;
            }
            /*.row-hover :hover {
                opacity: 0.8;
            }*/
            .red-error {
                color: red;
            }
        </style>

            <!-- page content -->
    <div >
        <div class="">

            <div  class="x_panel">

                <script>
                    $(document).ready(function() {

                        @if (count($errors) > 0)
                            showForm();
                        @endif

                        $(".session").click(function() {

                            var sessionID = this.id;
                            var sessionDate = $(this).find("input#session_date").val();

                            $.ajax({
                                        url: "/api/session/" + sessionID + "/free/"
                                    })
                                    .done(function( data ) {
                                        //console.log( data );
                                        if ( data.success == true ) {
                                            $("#err_block").hide();
                                            formActions(sessionID, sessionDate);
                                        }
                                        else {
                                            errMessage(data.message);
                                            hideForm();
                                        }
                                    });
                        });

                        function showForm()
                        {
                            $("#form").show();
                        }

                        function hideForm()
                        {
                            $("#form").hide();
                        }

                        function formActions(sessionID, sessionDate)
                        {
                            showForm();
                            $('html, body').animate({
                                scrollTop: $("#form").offset().top
                            }, 2000);
                            var el = $("input:text").get(0);
                            var elemLen = el.value.length;
                            el.selectionStart = elemLen;
                            el.selectionEnd = elemLen;
                            el.focus();
                            $('#session-input').val(sessionID);
                            $('input#enrolment_exam').val(sessionDate)
                        }

                        function errMessage(message)
                        {
                            $("#err_block").show();
                            $("#err_message").html(message);
                            $('html, body').animate({
                                scrollTop: $("#err_block").offset().top
                            }, 2000);
                        }

                        // Shows depends from university_code
                        var univerCodeEl = $('.university_code');
                        var oldUniversityCode = <?php if (old('university_code')) echo old('university_code'); else echo 1; ?>;
                        console.log("after page loaded: university code value :" + oldUniversityCode);
                        appearDepUniver(oldUniversityCode);
                        univerCodeEl.change(function() {
                            var value = $(this).val();
                            appearDepUniver(value);
                        });
                        function appearDepUniver(value) {
                            var el4 = $('div.personal_code');
                            var el5 = $('div.matricola');
                            var el6 = $('div.university');
                            var el7 = $('div.school');
                            var el8 = $('.fiscal_code');
                            var el9 = $('.vat');
                            if(value == {{ \App\Student::POLYTECHNIC_STUDENT }}) {
                                el4.show(); el5.hide(); el6.hide(); el7.show(); el8.show(); el9.hide();
                            }
                            else if(value == {{ \App\Student::OTHER_UNIVERSITY }}) {
                                el4.hide(); el5.show(); el6.show(); el7.show(); el8.show(); el9.hide();
                            }
                            else if(value == {{ \App\Student::COMPANY }}) {
                                el4.hide(); el5.hide(); el6.hide(); el7.hide(); el8.show(); el9.show();
                            }
                            else if(value == {{ \App\Student::UNIVERSITY_PRIVATE }}) {
                                el4.hide(); el5.hide(); el6.hide(); el7.hide(); el8.show(); el9.hide();
                            }
                        }

                        // If not in Italia, appear NATION
                        var citiesEl = $('#city');
                        showNation(citiesEl.val());
                        citiesEl.change(function() {
                            var val = $(this).val();
                            showNation(val);
                        });
                        function showNation(val) {
                            //console.log("cities: " + val);
                            if(val == "-1") {
                                $('.nation').show();
                            }
                            else {
                                $('.nation').hide();
                            }
                        }

                        // If exam already taken, show eat_city
                        var examTakenEl = $('input[name=exam_already_taken]:checked');
                        showEatCity(examTakenEl.val());
                        $('input[name=exam_already_taken]').change(function() {
                            var val = this.value;
                            showEatCity(val);
                        });
                        function showEatCity(val) {
                            if(val == {{ \App\Student::YES }}) {
                                $('.eat_city').show();
                            }
                            else {
                                $('.eat_city').hide();
                            }
                        }

                        // Check display size
                        var screenWidth = window.screen.availWidth;
                        $('#screen_width').val(screenWidth);
                    });



                </script>

                <div class="row">

                    @if(Session::get('msg'))
                        <div class="row">
                            <div class="alert alert-success" role="alert" style="text-align:center; margin: 0 50px 0 50px;">
                                {{ trans(Session::get('msg')) }}
                            </div>
                        </div>
                    @endif

                        <div id="err_block" style="display: none;" class="row">
                            <div id="err_message" class="alert alert-danger" role="alert" style="text-align:center; margin: 0 50px 0 50px;">

                            </div>
                        </div>


                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                        @foreach($sessions as $session)
                            <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-10 session" id="{{ $session->id }}">
                                        <div class="col-md-9 col-sm-12 col-xs-12 description">
                                            {{ $session->getDate() }} - {{ $session->description }} ({{ $session->freePlaces() ?: 'FULL' }})
                                        </div>
                                        <input type="hidden" id="session_date" value="{{ localDate($session->date) }}">
                                        <div class="col-md-3 col-sm-12 col-xs-12 contact">
                                            <button class="button-contact">Contattaci</button>
                                        </div>
                                    </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Form -->
                    <?php $a = 3; $b = 9; $c = 4; $d = 7; ?>
                    <form method="post" action="/user/create">
                    <div style="display: none;" id="form" style="margin-top: 100px" class="col-lg-3 col-md-3 col-sm-3 col-xs-11 col-lg-offset-1 col-md-offset-1 col-xs-offset-1">
                        <!-- -------------------------------------------------------------------------------- -->
                        <input type="hidden" value="{{ old('session_id') }}" name="session_id" id="session-input">
                        <input type="hidden" value="{{ old('screen_width') }}" name="screen_width" id="screen_width">
                        <!-- -------------------------------------------------------------------------------- -->
                        <div class="row form-group row-hover">
                            <div class="col-md-<?php echo $a; ?> col-sm-<?php echo $a; ?> col-xs-<?php echo $c; ?>"><label>* Iscrizione Esame del</label></div>
                            <div class="col-md-<?php echo $b; ?> col-sm-<?php echo $b; ?> col-xs-<?php echo $d; ?>">
                                <input type="date" class="form-control" placeholder="" value="{{ localDate(old('enrolment_exam')) }}" name="enrolment_exam" id="enrolment_exam">
                                @if ($errors->has('enrolment_exam'))
                                    <div class="form-error red-error">
                                        {{ $errors->first('enrolment_exam') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <!-- -------------------------------------------------------------------------------- -->
                        <div class="row form-group row-hover">
                            <div class="col-md-<?php echo $a; ?> col-sm-<?php echo $a; ?> col-xs-<?php echo $c; ?>"><label>* Nome</label></div>
                            <div class="col-md-<?php echo $b; ?> col-sm-<?php echo $b; ?> col-xs-<?php echo $d; ?>">
                                <input type="text" class="form-control" placeholder="" value="{{ old('name') }}" name="name">
                                @if ($errors->has('name'))
                                    <div class="form-error red-error">
                                        {{ $errors->first('name') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <!-- -------------------------------------------------------------------------------- -->
                        <div class="row form-group row-hover">
                            <div class="col-md-<?php echo $a; ?> col-sm-<?php echo $a; ?> col-xs-<?php echo $c; ?>"><label>* Cognome</label></div>
                            <div class="col-md-<?php echo $b; ?> col-sm-<?php echo $b; ?> col-xs-<?php echo $d; ?>">
                                <input type="text" class="form-control" placeholder="" value="{{ old('surname') }}" name="surname">
                                @if ($errors->has('surname'))
                                    <div class="form-error red-error">
                                        {{ $errors->first('surname') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <!-- -------------------------------------------------------------------------------- -->
                        <div class="row form-group row-hover">
                            <div class="col-md-<?php echo $a; ?> col-sm-<?php echo $a; ?> col-xs-<?php echo $c; ?>"></div>
                            <div class="col-md-<?php echo $b; ?> col-sm-<?php echo $b; ?> col-xs-<?php echo $d; ?>">
                                @foreach(config('university_codes') as $id => $code)
                                    <div class="row">
                                        <div class="col-md-<?php echo $a; ?> col-sm-<?php echo $a; ?> col-xs-<?php echo $c; ?>">
                                            <input
                                                    type="radio"
                                                    class="form-control university_code"
                                                    name="university_code"
                                                    id=""
                                                    value="{{ $id }}"
                                                    @if(old('university_code') == $id)
                                                    checked="checked"
                                                    @endif
                                            >
                                        </div>
                                        <div class="col-md-<?php echo $b; ?> col-sm-<?php echo $b; ?> col-xs-<?php echo $d; ?>">
                                            {{ $code }}
                                        </div>
                                    </div>
                                @endforeach
                                @if ($errors->has('university_code'))
                                    <div class="form-error red-error">
                                        {{ $errors->first('university_code') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <!-- -------------------------------------------------------------------------------- -->
                        <div class="row form-group row-hover personal_code">
                            <div class="col-md-<?php echo $a; ?> col-sm-<?php echo $a; ?> col-xs-<?php echo $c; ?>"><label> Codice Persona</label></div>
                            <div class="col-md-<?php echo $b; ?> col-sm-<?php echo $b; ?> col-xs-<?php echo $d; ?>">
                                <input type="text" class="form-control" placeholder="" value="{{ old('personal_code') }}" name="personal_code" id="personal_code">
                                @if ($errors->has('personal_code'))
                                    <div class="form-error red-error">
                                        {{ $errors->first('personal_code') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <!-- -------------------------------------------------------------------------------- -->
                        <div class="row form-group row-hover matricola">
                            <div class="col-md-<?php echo $a; ?> col-sm-<?php echo $a; ?> col-xs-<?php echo $c; ?>"><label>* Matricola</label></div>
                            <div class="col-md-<?php echo $b; ?> col-sm-<?php echo $b; ?> col-xs-<?php echo $d; ?>">
                                <input type="text" class="form-control" placeholder="" value="{{ old('matricola') }}" name="matricola" id="matricola">
                                @if ($errors->has('matricola'))
                                    <div class="form-error red-error">
                                        {{ $errors->first('matricola') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <!-- -------------------------------------------------------------------------------- -->
                        <div class="row form-group row-hover university">
                            <div class="col-md-<?php echo $a; ?> col-sm-<?php echo $a; ?> col-xs-<?php echo $c; ?>"><label>* Universita</label></div>
                            <div class="col-md-<?php echo $b; ?> col-sm-<?php echo $b; ?> col-xs-<?php echo $d; ?>">
                                <select name="university" id="university" class="form-control">
                                    @foreach(config('universities') as $id => $university)
                                        <option
                                                @if(old('university') == $id)
                                                selected="selected"
                                                @endif
                                                value="{{ $id }}">{{ $university }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('university'))
                                    <div class="form-error red-error">
                                        {{ $errors->first('university') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <!-- -------------------------------------------------------------------------------- -->
                        <div class="row form-group row-hover school">
                            <div class="col-md-<?php echo $a; ?> col-sm-<?php echo $a; ?> col-xs-<?php echo $c; ?>"><label>* Facolta</label></div>
                            <div class="col-md-<?php echo $b; ?> col-sm-<?php echo $b; ?> col-xs-<?php echo $d; ?>">
                                {{--<select name="school" id="school" class="form-control">
                                    @foreach(config('schools') as $id => $school)
                                        <option
                                                @if(old('school') == $id)
                                                selected="selected"
                                                @endif
                                                value="{{ $id }}">{{ $school }}</option>
                                    @endforeach
                                </select>--}}
                                <input type="text" name="school" id="school" class="form-control" value="{{ old('school') }}">
                                @if ($errors->has('school'))
                                    <div class="form-error red-error">
                                        {{ $errors->first('school') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <!-- -------------------------------------------------------------------------------- -->
                        <div class="row form-group row-hover">
                            <div class="col-md-<?php echo $a; ?> col-sm-<?php echo $a; ?> col-xs-<?php echo $c; ?>"><label>* <span class="fiscal_code">Cod. Fiscale</span> - <span class="vat">* P.IVA</span></label></div>
                            <div class="col-md-<?php echo $b; ?> col-sm-<?php echo $b; ?> col-xs-<?php echo $d; ?>">
                                <input type="text" class="form-control fiscal_code" placeholder="" value="{{ \Illuminate\Support\Str::upper(old('fiscal_code')) }}" name="fiscal_code" id="fiscal_code">
                                @if ($errors->has('fiscal_code'))
                                    <div class="form-error red-error">
                                        {{ $errors->first('fiscal_code') }}
                                    </div>
                                @endif
                                <input type="text" class="form-control vat" placeholder="" value="{{ \Illuminate\Support\Str::upper(old('vat')) }}" name="vat" id="vat">
                                @if ($errors->has('vat'))
                                    <div class="form-error red-error">
                                        {{ $errors->first('vat') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <!-- -------------------------------------------------------------------------------- -->
                        <div class="row form-group row-hover">
                            <div class="col-md-<?php echo $a; ?> col-sm-<?php echo $a; ?> col-xs-<?php echo $c; ?>"><label>* Nato a</label></div>
                            <div class="col-md-<?php echo $b; ?> col-sm-<?php echo $b; ?> col-xs-<?php echo $d; ?>">
                                <input type="text" class="form-control" placeholder="" value="{{ old('born_in') }}" name="born_in" id="born_in">
                                @if ($errors->has('born_in'))
                                    <div class="form-error red-error">
                                        {{ $errors->first('born_in') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <!-- -------------------------------------------------------------------------------- -->
                        <div class="row form-group row-hover nation">
                            <div class="col-md-<?php echo $a; ?> col-sm-<?php echo $a; ?> col-xs-<?php echo $c; ?>"><label>* Nazione</label></div>
                            <div class="col-md-<?php echo $b; ?> col-sm-<?php echo $b; ?> col-xs-<?php echo $d; ?>">
                                <select class="form-control" name="nation" id="nation">
                                    @foreach(config('countries') as $id => $country)
                                        <option
                                                @if(old('nation') == $id)
                                                selected="selected"
                                                @endif
                                                value="{{ $id }}">{{ $country }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('nation'))
                                    <div class="form-error red-error">
                                        {{ $errors->first('nation') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <!-- -------------------------------------------------------------------------------- -->
                        <div class="row form-group row-hover">
                            <div class="col-md-<?php echo $a; ?> col-sm-<?php echo $a; ?> col-xs-<?php echo $c; ?>"><label>* Provincia</label></div>
                            <div class="col-md-<?php echo $b; ?> col-sm-<?php echo $b; ?> col-xs-<?php echo $d; ?>">
                                <select class="form-control" name="province">
                                    @foreach(config('provinces') as $id => $province)
                                        <option
                                                @if(old('province') == $id)
                                                    selected="selected"
                                                @endif
                                                value="{{ $id }}">{{ $province }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('provinces'))
                                    <div class="form-error red-error">
                                        {{ $errors->first('provinces') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <!-- -------------------------------------------------------------------------------- -->
                        <div class="row form-group row-hover">
                            <div class="col-md-<?php echo $a; ?> col-sm-<?php echo $a; ?> col-xs-<?php echo $c; ?>"><label>* Data nascita: </label></div>
                            <div class="col-md-<?php echo $b; ?> col-sm-<?php echo $b; ?> col-xs-<?php echo $d; ?>">
                                <input type="date" class="form-control" placeholder="" value="{{ old('date_of_birth') }}" name="date_of_birth">
                                @if ($errors->has('date_of_birth'))
                                    <div class="form-error red-error">
                                        {{ $errors->first('date_of_birth') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <!-- -------------------------------------------------------------------------------- -->
                        <div class="row form-group row-hover">
                            <div class="col-md-<?php echo $a; ?> col-sm-<?php echo $a; ?> col-xs-<?php echo $c; ?>"><label>Residente a:</label></div>
                        </div>
                        <!-- -------------------------------------------------------------------------------- -->
                        <div class="row form-group row-hover">
                            <div class="col-md-<?php echo $a; ?> col-sm-<?php echo $a; ?> col-xs-<?php echo $c; ?>"><label>Indirizzo"</label></div>
                            <div class="col-md-<?php echo $b; ?> col-sm-<?php echo $b; ?> col-xs-<?php echo $d; ?>">
                                <input type="text" class="form-control" placeholder="" value="{{ old('address') }}" name="address">
                            </div>
                        </div>
                        <!-- -------------------------------------------------------------------------------- -->
                        <div class="row form-group row-hover">
                            <div class="col-md-<?php echo $a; ?> col-sm-<?php echo $a; ?> col-xs-<?php echo $c; ?>"><label>Città</label></div>
                            <div class="col-md-<?php echo $b; ?> col-sm-<?php echo $b; ?> col-xs-<?php echo $d; ?>">
                                <!--{{--<input class="form-control" name="city" id="city" value="{{ old('city') }}">--}}-->
                                <select class="form-control" name="city" id="city">
                                    @foreach(config('cities') as $id => $city)
                                        <option
                                                @if(old('city') == $id)
                                                selected="selected"
                                                @endif
                                                value="{{ $id }}">{{ $city }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('city'))
                                    <div class="form-error red-error">
                                        {{ $errors->first('city') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <!-- -------------------------------------------------------------------------------- -->
                        <div class="row form-group row-hover">
                            <div class="col-md-<?php echo $a; ?> col-sm-<?php echo $a; ?> col-xs-<?php echo $c; ?>"><label>N°:</label></div>
                            <div class="col-md-<?php echo $b; ?> col-sm-<?php echo $b; ?> col-xs-<?php echo $d; ?>">
                                <input type="text" class="form-control" placeholder="" value="{{ old('number') }}" name="number">
                                @if ($errors->has('number'))
                                    <div class="form-error red-error">
                                        {{ $errors->first('number') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <!-- -------------------------------------------------------------------------------- -->
                        <div class="row form-group row-hover">
                            <div class="col-md-<?php echo $a; ?> col-sm-<?php echo $a; ?> col-xs-<?php echo $c; ?>"><label>Cap:</label></div>
                            <div class="col-md-<?php echo $b; ?> col-sm-<?php echo $b; ?> col-xs-<?php echo $d; ?>">
                                <input type="text" class="form-control" placeholder="" value="{{ old('cap') }}" name="cap">
                                @if ($errors->has('cap'))
                                    <div class="form-error red-error">
                                        {{ $errors->first('cap') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <!-- -------------------------------------------------------------------------------- -->
                        <div class="row form-group row-hover">
                            <div class="col-md-<?php echo $a; ?> col-sm-<?php echo $a; ?> col-xs-<?php echo $c; ?>"><label>* Telefono</label></div>
                            <div class="col-md-<?php echo $b; ?> col-sm-<?php echo $b; ?> col-xs-<?php echo $d; ?>">
                                <input type="text" class="form-control" placeholder="" value="{{ old('phone') }}" name="phone">
                                @if ($errors->has('phone'))
                                    <div class="form-error red-error">
                                        {{ $errors->first('phone') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <!-- -------------------------------------------------------------------------------- -->
                        <div class="row form-group row-hover">
                            <div class="col-md-<?php echo $a; ?> col-sm-<?php echo $a; ?> col-xs-<?php echo $c; ?>"><label>* e-mail</label></div>
                            <div class="col-md-<?php echo $b; ?> col-sm-<?php echo $b; ?> col-xs-<?php echo $d; ?>">
                                <input type="email" class="form-control" placeholder="" value="{{ old('email') }}" name="email">
                                @if ($errors->has('email'))
                                    <div class="form-error red-error">
                                        {{ $errors->first('email') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <!-- -------------------------------------------------------------------------------- -->
                        <div class="row form-group row-hover">
                            <div class="col-md-<?php echo $a; ?> col-sm-<?php echo $a; ?> col-xs-<?php echo $c; ?>"><label>Hai già sostenuto l'esame?</label></div>
                            <div class="col-md-<?php echo $b; ?> col-sm-<?php echo $b; ?> col-xs-<?php echo $d; ?>">
                                <div class="row">
                                    <div class="col-md-1">
                                        <label>Si</label>
                                    </div>
                                    <div class="col-md-2">
                                        <input
                                                type="radio"
                                                class="form-control"
                                                placeholder=""
                                                @if(old('exam_already_taken') == \App\Student::YES)
                                                checked="checked"
                                                @endif
                                                value="{{ \App\Student::YES }}"
                                                name="exam_already_taken"
                                                id="exam_already_taken">
                                    </div>
                                    <div class="col-md-1">
                                        <label>No</label>
                                    </div>
                                    <div  class="col-md-2">
                                        <input
                                                type="radio"
                                                class="form-control"
                                                placeholder=""
                                                @if(old('exam_already_taken') == \App\Student::NO)
                                                checked="checked"
                                                @endif
                                                value="{{ \App\Student::NO }}"
                                                name="exam_already_taken"
                                                id="exam_already_taken">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- -------------------------------------------------------------------------------- -->
                        <div class="row form-group row-hover eat_city">
                            <div class="col-md-<?php echo $a; ?> col-sm-<?php echo $a; ?> col-xs-<?php echo $c; ?>"><label>Dove?</label></div>
                            <div class="col-md-<?php echo $b; ?> col-sm-<?php echo $b; ?> col-xs-<?php echo $d; ?>">
                                <input type="text" class="form-control" placeholder="" value="{{ old('eat_city') }}" name="eat_city">
                                @if ($errors->has('eat_city'))
                                    <div class="form-error red-error">
                                        {{ $errors->first('eat_city') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <!-- -------------------------------------------------------------------------------- -->
                        <div class="row form-group row-hover">
                            <div class="col-md-<?php echo $a; ?> col-sm-<?php echo $a; ?> col-xs-<?php echo $c; ?>"><label>Come ci hai conosciuto:</label></div>
                            <div class="col-md-<?php echo $b; ?> col-sm-<?php echo $b; ?> col-xs-<?php echo $d; ?>">
                                @foreach (config('know_us') as $key => $know_us)
                                    <div class="row">
                                        <div class="col-md-2">
                                            <input
                                                    type="radio"
                                                    class="form-control"
                                                    placeholder=""
                                                    value="{{ $key }}"
                                                    @if(old('know_us') == $key)
                                                    checked="checked"
                                                    @endif
                                                    name="know_us"
                                                    id="know_us">
                                        </div>
                                        <div class="col-md-10">
                                            <label>{{ $know_us }}</label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- -------------------------------------------------------------------------------- -->
                        {{ csrf_field() }}
                        <div class="row form-group row-hover">
                            <div style="text-align: right;" class="col-md-12">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>

            </div>



        </div>
    </div>
    <!-- /page content -->
@endsection