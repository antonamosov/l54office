@extends('layouts.admin')

@section('title')
    Anagrafica - BLS
    @endsection

@section('header-scripts')
    <style type="text/css">
        .ricerca {
            font-family: Verdana, Geneva, sans-serif;
            font-size: 12px;
            font-weight: bold;
        }

        .ricerca tbody tr td {
            font-size: 12px;
        }

        .size {
            font-size: 12px;
            font-weight: bold;
        }

        .size1 {
            font-size: 12px;
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        }

        .choice {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
            text-align: left;
        }

        .left {
            text-align: left;
        }

        .testobianco {
            color: #FFF;
        }

        .form-error {
            color: red;
        }
        .codes-font {
            font-weight: 500;
        }
        .edit {
            font-weight: 500;
        }
        .combo {
            font-weight: 500;
        }
        .exam {
            font-weight: 500;
        }
    </style>
    @endsection

@section('content')
    <div class="right_col" role="main" id="firstElement">

        <div class="form-error alert-success" style="text-align: left; padding-left: 20px;">
            <p id="infoMessage">
                @if(Session::has('infoMessage'))
                    {{ Session::get('infoMessage') }}
                @endif
            </p>
        </div>

        {{--@include('includes.message_block')--}}

    <form id="form-this" action="@if($student->isNew()) /{{ $student->session_id }}/user/create @else /user/update/{{ $student->id }} @endif" method="post">

        <table width="100%" border="1" cellpadding="3" cellspacing="1">

            @include('student._user_fields')

            @include('student._user_table_footer')

        </table>

        <input type="hidden" name="session_id" value="{{ $student->session_id }}">
        <input type="hidden" name="order_id" value="{{ $student->order_id }}">
        <input type="hidden" id="send_code" name="send_code" value="{{ $student->send_code }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

    </form>
</div>



    <script>
        $(document).ready(function() {

            $(".send-email-select").change(function(){
                var value = $(this).val();
                var id = $(this).attr('id');
                $('.send-email-input#' + id).attr('email', value);
            });

            // Change exam
            var examEl = $('select.exam');
            var examArr = examEl.val();
            setExamSums(examArr);

            examEl.change(function() {
                setExamSums($(this).val())
            });

            // Send info to server about this student is editing now
            var editing =  '<?php echo ($student->isNew() ? 0 : 1 ); ?>';
            var stID = '<?php echo $student->id; ?>';
            if(editing == 1) {
                editingF();
                setInterval(editingF , 10000);

                // Check if not editng by another nmanager
                $.ajax({
                    url: '/api/check-editing/' + stID,
                    method : 'GET',
                    success: function(data) {
                        if(data.success == true) {
                            console.log("check editing");
                            $('.editing').html(data.message);
                        }
                    }
                });
            }
            function editingF() {
                $.ajax({
                    url: '/api/is-editing/' + stID,
                    method : 'GET',
                    success: function(data) {
                        if(data.success == true) {
                            console.log("is editing");
                        }
                    }
                });
            }
        });

        function setExamSums(examArr) {
            $("table.summary").html("");
            var examJson = JSON.stringify(examArr);

            $.ajax({
                url: "/api/exam?exams=" + examJson
            })
                .done(function( data ) {
                    console.log(data);
                    $.each(data.exams, function(index, exam) {
                        var tableRow = $("<tr><td align='center' bgcolor='#FFFFFF' class='choice'>"
                            + exam.title
                            + "</td><td align='center' bgcolor='#FFFFFF'>"
                            + exam.price_without_vat
                            + "</td></tr>");
                        $("table.summary").append(tableRow);
                    });
                    var lastTableRow = $("<tr><td align='center' bgcolor='#FFFFFF' class='choice'><span class='ricerca'>Total amount:</span></td>"
                        + "<td align='center' bgcolor='#FFFFFF'><span class='ricerca'>€<span class='total'>"
                        + data.total_sum
                        + "</span>"
                        + "<span class='choice'><span class='size'></span></span></span></td>"
                        + "<input type='hidden' name='total' class='total' value="
                        + data.total_sum
                        + "><input class=exam_sum value='" +
                        + data.total_sum_without_vat
                        + "'>");
                    $("table.summary").append(lastTableRow);
                });
        }

        function infoBar(message) {
            $('#infoMessage').html(message);
            progressBar();
            function progressBar() {
                var infoEl = $('#infoMessage');
                var infoVal = infoEl.html();
                infoEl.html(infoVal + ' .');
                setTimeout( progressBar, 500 );
            }
        }

        function sendEmail(el) {
            var id = $(el).attr('id');
            var emailID = $('.send-email-input#' + id).attr('email');
            var email = $('#email').val();
            var studentId = '<?php echo $student->id; ?>';
            infoBar('Please wait . . .');
            $('html, body').animate({
                scrollTop: $("#firstElement").offset().top
            }, 500);
            if(emailID.length) {
                $.ajax({
                    url: "/api/email/template/" + emailID + '/?email=' + email + '&student_id=' + studentId
                })
                    .done(function( data ) {
                        if ( data.success == true ) {
                            $('span#' + id).html(' sent ' + data.date);
                            $('input#' + id + '.hidden-input').val(data.date);
                            $('img#' + id).show();
                            $('#form-this').submit();
                        }
                        else {
                            $('#infoMessage').html('Error...');
                            console.log('error send message');
                        }
                    });
            }
            else {
                alert("Please firstly save student");
            }

            return false;
        }

        function sendInvoice()
        {
            data = {
                fiscal_code: $('input#fiscal_code').val(),
                email: $('input#email').val(),
                'name' : $('input#name').val(),
                'surname' : $('input#surname').val(),
                'city_id' : $('select#city').val(),
                'street' : $('input#street').val(),
                'number' : $('input#number').val(),
                'sum' : $('input.exam-sum').val(),
                'total' : $('input.total').val(),
                'postal_code' : $('input#postal_code').val(),
                'description' : $('textarea#description').val(),
                'student_id': {{ $student->id }},
                'progressive_number' : $('input#invoice_number_1').val()
            };
            var resSpanEl = $('span.invoice_send');
            var resImgEl = $('img.invoice_send');
            resSpanEl.html('sending...');
            resSpanEl.css('color', 'green');
            $.ajax({
                        url: "/api/email/invoice",
                        method: "POST",
                        data: data,
                        success: function(data) {
                            if ( data.success == true ) {
                                resSpanEl.html('success: ' + data.date);
                                resImgEl.show();
                                $('input.print_course_invoice').attr('id', data.id);
                            }
                            else {
                                console.log('error send invoice');
                                resSpanEl.css('color', 'red');
                                resSpanEl.html('error: ' + data.message);
                            }
                        }
                    })
        }

        // send code
        $('input.send_code').click(function() {
            $('input#send_code').val($(this).attr('id'));
        });

        // Print invoice
        $('input.print_course_invoice').click(function() {
            $('span.print_course_invoice').html();
           if($(this).attr('id')) {
               window.open('/invoice/' + $(this).attr('id') + '/show', '_blank');
           }
            else {
               var studentId = {{ $student->id }};
               window.open('/invoice/show/' + studentId, '_blank');
           }
            return false;
        });

        // Print receipt
        $('input.print_receipt').click(function() {
            $('span.print_receipt').html();
            if($(this).attr('id')) {
                window.open('/receipt/' + $(this).attr('id') + '/show', '_blank');
            }
            else {
                $('span.print_receipt').html('Please firstly save student');
            }
            return false;
        });

        // Print toeic invoice
        $('input.print_toeic_invoice').click(function() {
            $('span.print_toeic_invoice').html();
            var studentId = {{ $student->id }};
            if($(this).attr('id')) {
                window.open('/invoice/' + $(this).attr('id') + '/toeic_show/' + studentId, '_blank');
            }
            else {
                window.open('/invoice/toeic_show/' + studentId, '_blank');
            }
            return false;
        });

        // Print records
        $('input.print_records').click(function() {
            var studentId = {{ $student->id }};
            window.open('/user/edit/' + studentId + '/print', '_blank');
            return false;
        });

    </script>

@endsection