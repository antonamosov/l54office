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



                <div class="x_panel">

                    <div class="x_content">

                        @include('student._user_table')

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