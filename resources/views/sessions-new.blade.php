@extends('layouts.showcase')

@section('title')
    Sessions
    @endsection

    @section('content')

        <style type="text/css">
            .session {
                margin: 50px;
                padding: 20px;
                background-color: #407bcc;
                color: white;
                text-align: left;
                width:60%;
                font-size: 30px;
                cursor: pointer;
            }
            .description {
                width:80%;
                display: inline-block;
            }
            .contact {
                width:10%;
                display: inline-block;
            }
            .button {
                background-color: #407bcc;
                color: white;
                margin: 10px;
                padding: 10px;
                font-size: 30px;
                cursor: pointer;
            }
        </style>

            <!-- page content -->
    <div class="right_col" role="main">
        <div class="">

            <div class="clearfix"></div>


            <div class="x_panel">

                <script>
                    $(document).ready(function() {
                        $(".session").click(function () {
                            window.location.href = "/" + this.id + "/user/create";
                        });
                    });
                </script>

                @foreach($sessions as $session)
                    <div class="session" id="{{ $session->id }}">
                        <div class="description">
                            {{ $session->getDate() }} - {{ $session->description }} ({{ $session->freePlaces() ?: 'posti disponibili' }})
                        </div>
                        <div class="contact">
                            <button class="button">Contattaci</button>
                        </div>
                    </div>
                @endforeach

            </div>



        </div>
    </div>
    <!-- /page content -->
@endsection