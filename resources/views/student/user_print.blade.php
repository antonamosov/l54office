@extends('layouts.print')

@section('title')
    Search - Back Office
@endsection

@section('content')

    <!-- page content -->

    <div class="">

        <div class="clearfix"></div>
        <div class="col-md-12 col-sm-12 col-xs-12">

            <style>
                .search-padding {
                    padding: 10px 5px;
                }
                .search-margin {
                    margin-left: 20px;
                    margin-right: 20px;
                }
            </style>

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
            </style>



            <div class="x_panel">

                <div class="x_content">

                    <table width="100%" border="1" cellpadding="3" cellspacing="1">

                        @include('student._user_fields')

                    </table>

                </div>
            </div>
        </div>
    </div>

    <form method="post" action="/excel" id="json-table-form">
        <input type="hidden" name="table" id="json-table-field" value="">
        <input type="hidden" name="header" id="header-field" value="">
        {{ csrf_field() }}
    </form>


    <!-- /page content -->
@endsection