@extends('layouts.admin')

@section('title')
    Import - Back Office
@endsection

@section('content')

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Import excel file</h3>
                </div>

            </div>

            <div class="clearfix"></div>

            @include('includes.message_block')


            <div class="x_panel">

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_content">
                                <br/>

                                <form method="post" action="" class="form-horizontal form-label-left" enctype="multipart/form-data">

                                    <div class="form-group attachment">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="excel_file">Excel file
                                        </label>

                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="file" name="excel_file">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                            <button type="submit" class="btn btn-success">Submit</button>
                                            <a href="/import/upload_csv" class="btn btn-success">Next</a>
                                        </div>
                                    </div>

                                    {{ csrf_field() }}

                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


        </div>
    </div>
    <!-- /page content -->
@endsection