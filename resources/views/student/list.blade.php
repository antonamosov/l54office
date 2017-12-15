@extends('layouts.admin')

@section('title')
        Search - Back Office
@endsection

@section('content')

        <!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3 id="header">Search - BLS</h3>
            </div>

            <div class="title_right">
                <div class="col-md-6 col-sm-6 col-xs-12 form-group pull-right">
                    <div class="dt-buttons btn-group">
                        <a class="btn btn-default buttons-copy buttons-html5 btn-sm print-button"
                           tabindex="0"
                           aria-controls="datatable-buttons"
                           target="_blank"
                           onclick="printButtonClick(this);"
                           href="/user/print">
                            <i class="fa fa-print"></i> <span>Print selected</span>
                        </a>
                        <a      id="excel"
                                class="btn btn-default buttons-csv buttons-html5 btn-sm"
                                tabindex="0"
                                aria-controls="datatable-buttons"
                                href="#">
                            <i class="fa fa-external-link-square"></i> <span>Export selected</span>
                        </a>
                        <a
                                class="btn btn-default buttons-csv buttons-html5 btn-sm"
                                tabindex="0"
                                aria-controls="datatable-buttons"
                                id="erase"
                                href="#">
                            <i class="fa fa-trash"></i> <span>Erase</span>
                        </a>
                    </div>
                </div>
                <div class="col-md-2 col-sm-2 col-xs-3 form-group pull-right">
                    <a class="group-sending btn btn-success">Invia</a>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-9 form-group pull-right">
                    <select class="group-sending form-control">
                        @foreach(\App\Email::getAllNonAuto() as $email)
                            <option value="{{ $email->id }}">{{ $email->name }}</option>
                        @endforeach
                    </select>
                    <input type="hidden" value="" class="group-sending">
                </div>
            </div>



        </div>

        <div class="clearfix"></div>
        <div class="col-md-12 col-sm-12 col-xs-12">

            <style>
                .search-padding {
                    padding: 10px;
                }
                @media (min-width: 1340px) {
                    .btn-search {
                        padding-left: 30px;
                        padding-right: 30px;
                    }
                }
            </style>


             <form action="" method="get" id="search-form">
                 <div class="row" style="margin: 20px;">
                    <div class="col-md-2 col-sm-6 col-xs-6 search-padding" style="background-color: #96B524; color: black; padding: 0">
                        <div class="form-control" style="background-color: #96B524; border: 0;"><i class="fa fa-search"></i> Search for:</div>
                    </div>
                    <div class="col-md-2 col-sm-6 search-padding search-margin">
                        <input class="form-control" type="text" value="{{ \Illuminate\Support\Facades\Input::has('surname') ? \Illuminate\Support\Facades\Input::get('surname') : '' }}" id="surname" name="surname" placeholder="surname">
                    </div>
                    <div class="col-md-2 col-sm-6 search-padding search-margin">
                        <input class="form-control" type="text" value="{{ \Illuminate\Support\Facades\Input::has('name') ? \Illuminate\Support\Facades\Input::get('name') : '' }}" id="name" name="name" placeholder="name">
                    </div>
                    <div class="col-md-2 col-sm-6 search-padding search-margin">
                        <input class="form-control" type="text" value="{{ \Illuminate\Support\Facades\Input::has('email') ? \Illuminate\Support\Facades\Input::get('email') : '' }}" id="email" name="email" placeholder="e-mail">
                    </div>
                    <div class="col-md-2 col-sm-6 search-padding search-margin">
                        <input class="form-control" type="text" value="{{ \Illuminate\Support\Facades\Input::has('phone') ? \Illuminate\Support\Facades\Input::get('phone') : '' }}" id="phone" name="phone" placeholder="phone">
                    </div>
                    <div class="col-md-2 col-sm-6 search-padding search-margin">
                        <input class="form-control" type="text" value="{{ \Illuminate\Support\Facades\Input::has('memo_1') ? \Illuminate\Support\Facades\Input::get('memo_1') : '' }}" id="memo_1" name="memo_1" placeholder="memo">
                    </div>
                 <!--</div>
                 <div class="row" style="margin: 20px;">-->
                    <div class="col-md-2 col-sm-6 col-xs-12 search-padding search-margin search-align">
                        <select name="enrolment_exam" id="exam_date" class="form-control">
                            <option value="">Exam date</option>
                            @foreach($sessions as $session)
                                <option
                                        @if(\Illuminate\Support\Facades\Input::get('enrolment_exam') == $session->date)
                                        selected="selected"
                                        @endif
                                        value="{{ $session->date }}">{{ $session->getDate() }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 col-sm-6 col-xs-12 search-padding search-margin search-align">
                        <select name="session_type" id="session_type" class="form-control">
                            <option value="">Session types</option>
                            @foreach($session_types as $s_type)
                                <option
                                        @if(\Illuminate\Support\Facades\Input::get('session_type') == $s_type->id)
                                        selected="selected"
                                        @endif
                                        value="{{ $s_type->id }}">{{ $s_type->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-1 col-sm-1 col-xs-6 search-padding">
                        <input type="submit" value="filter" class="btn btn-primary btn-search">
                    </div>
                     <div class="col-md-1 col-sm-1 col-xs-6 search-padding">
                        <button class="btn btn-warning btn-search reset" onclick="reset();" type="button" value="reset">reset</button>
                    </div>
                </form>
            </div>



            <span class="info-message" style="color: green;"></span>
            <span class="info-error" style="color: red;"></span>

            <div class="x_panel">

                <div class="x_content">

                    @include('student._user_table')

                </div>
            </div>
        </div>
    </div>
</div>
</div>
        <form target="_blank" method="post" action="/excel" id="json-table-form">
            <input type="hidden" name="table" id="json-table-field" value="">
            <input type="hidden" name="header" id="header-field" value="">
            {{ csrf_field() }}
        </form>
        <!-- jQuery -->
        <script src="/bower_components/gentelella/vendors/jquery/dist/jquery.min.js"></script>
        <script>
            // Confirm exam ajax
            $('input[type=radio][id=confirmed]').on('change', function() {
                console.log('checked');
                if( $(this).is(':checked') ) {
                    $.ajax({
                                url: "/api/student/" + $(this).attr('student_id') + "/confirm"
                            })
                            .done(function( data ) {
                                console.log( data );
                                if ( ! data.success == true ) {
                                    $("#confirmed").prop('checked', false);
                                }
                            });
                }
            });

            // Exam already taken ajax
            $('input[type=radio][id=exam_already_taken]').on('change', function() {
                console.log('checked');
                if( $(this).is(':checked') ) {
                    $.ajax({
                                url: "/api/student/" + $(this).attr('student_id') + "/exam_already_taken",
                                data: "value=" + $(this).val()
                            })
                            .done(function( data ) {
                                console.log( data );
                                if ( data.success == true ) {
                                    console.log('ajax.success');
                                }
                            });
                }
            });

            // Excel
            $('#excel').click(function() {
                console.log("Generator start...");
                //var table = $("#student-table");
                //console.log(table.html());

                var myRows = { myRows: [] };

                var $th = $('table th');
                $('table tbody tr').each(function(i, tr){
                    if($(tr).children().find('input[type=checkbox][id=single]').prop('checked')) {
                        var obj = {}, $tds = $(tr).find('td');
                        $th.each(function(index, th){
                            obj[$(th).text()] = $tds.eq(index).text();
                        });
                        myRows.myRows.push(obj);
                    }
                });
                var jsonTable = JSON.stringify(myRows);

                $('#json-table-field').val(jsonTable);
                var header = $('#header').html();
                $('#header-field').val(header);
                $('#json-table-form').submit();
            });

            $(document).ready(function(){
                //$('#datatable-checkbox').destroy();

                // Table
                $('#datatable-checkbox1').DataTable({
                    "ordering": false
                });
            });

            // Click on single checkbox
            $('input[type=checkbox][id=single]').on('change', function() {
                updateEmailList(this);
            });

            // Send email
            $("a.group-sending").click(function() {
                $('.info-message').html('Wait...');
                var mailId = $('select.group-sending').val();
                var students = $('input.group-sending').val();
                $.ajax({
                            url: "/api/email/templates/" + mailId,
                            data: {students: students},
                            method: 'post'
                        })
                        .done(function( data ) {
                            console.log( data );
                            if ( data.success == true ) {
                                console.log('ajax.success');
                                var jsonIds = $('input.group-sending').val();
                                var students = $.parseJSON(jsonIds);
                                console.log(students);
                                $.each(students, function(key, student) {
                                    console.log(student['sid']);
                                    $("tr#student-row_" + student['sid']).css('background-color', '#fff33e');
                                    $('input[type=checkbox][id=single]').removeAttr('checked');
                                });
                                $('.info-message').html('Successfully sent.');
                            }
                            else {
                                $('.info-message').html();
                                $('.info-error').html('Error while sent email to students.');
                            }
                        });
            });

            // Reset search
            function reset() {
                window.location = '/user';
                $("#exam_date").val("");
                $("#name").val("");
                $("#surname").val("");
                $("#email").val("");
                $("#phone").val("");
            }

            $('.reset').click(function() {
                window.location = '/user';
            });

            // Check all
            $('input[type=checkbox].checkbox-primary').click(function() {
                var singleEl = $('input[type=checkbox][id=single]');
                if($(this).prop("checked")) {
                    singleEl.prop("checked", true);
                }
                else {
                    singleEl.prop("checked", false);
                }
                singleEl.each(function() {
                    updateEmailList(this);
                });
            });

            // Update email list for sending
            function updateEmailList(thisEl) {
                var studentId = $(thisEl).attr('student_id');
                var jsonIds = $('input.group-sending').val();
                var students;
                if (jsonIds) {
                    students = $.parseJSON(jsonIds);
                }
                else {
                    students = new Array;
                }

                if($(thisEl).prop("checked")) {
                    students.push({
                        sid: studentId
                    });
                    console.log(students);
                    $("input.group-sending").val(JSON.stringify(students));
                }
                else {
                    for (var i = 0; i < students.length; i++) {
                        if(studentId === students[i].sid) {
                            students.splice(i, 1);
                        }
                    }
                    $("input.group-sending").val(JSON.stringify(students));
                }
            }

            // Remove students
            $('#erase').click(function() {
                $('.info-message').html('Wait...');
                var singleEl = $('input[type=checkbox][id=single]');
                var row;
                var studentId;
                if(confirm('Are you sure to remove these students?')) {
                    singleEl.each(function() {
                        if($(this).prop("checked")) {
                            row = $(this).parent().parent();
                            studentId = row.attr('id');
                            studentId = studentId.replace('student-row_', '');
                            $.ajax({
                                        url: "/api/student/" + studentId + "/delete"
                                    })
                                    .done(function( data ) {
                                        if ( data.success == true ) {
                                            row.remove();
                                            $('.info-message').html('Successfully deleted.');
                                            location.reload();
                                        }
                                        else {
                                            $('.info-message').html();
                                            $('.info-error').html('Error while remove student.');
                                        }
                                    });
                        }
                    });
                }
            });

            // click on print button
            function printButtonClick(printLink) {
                $(printLink).attr('href', '');
                var jsonIds = $('input.group-sending').val();
                if(jsonIds) {
                    var objIds = $.parseJSON(jsonIds);
                    var strIds = '';
                    var delimiter = '';
                    $.each(objIds, function(key, objIds) {
                        if(strIds) {
                            delimiter = ',';
                        }
                        strIds += delimiter + objIds['sid'];
                    });
                    $(printLink).attr('href', '/user/print?ids=' + strIds);
                }
                else {
                    $(printLink).attr('href', '/user/print');
                }
            }

            // Select as memo
            $(".select-as-memo").click(function() {
                var thisEl = $(this);
                var stID = thisEl.attr('id');
                $.ajax({
                    url: '/api/select-as-memo/' + stID,
                    method : 'GET',
                    success: function(data) {
                        if(data.success == true) {
                            //console.log("select-as-memo");
                            if(thisEl.hasClass('btn-danger')) {
                                thisEl.removeClass('btn-danger');
                                thisEl.addClass('btn-default');
                            }
                            else {
                                thisEl.removeClass('btn-default');
                                thisEl.addClass('btn-danger');
                            }
                        }
                    }
                });
                return false;
            });
        </script>

<!-- /page content -->
@endsection