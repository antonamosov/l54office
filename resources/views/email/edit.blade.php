@extends('layouts.admin')

@section('title')
    Email - Back Office
@endsection

@section('header-scripts')
    <!-- jQuery -->
    <script src="/bower_components/gentelella/vendors/jquery/dist/jquery.min.js"></script>
@endsection

    @section('content')

            <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Email</h3>
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

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-1 col-sm-1 col-xs-1 col-md-offset-3">
                                                <button type="submit" class="btn btn-success">Submit</button>
                                            </div>
                                            <div class="col-md-1 col-sm-1 col-xs-1">
                                                <a href="/email/{{ $template->id }}/pdf/create" type="submit" class="btn btn-success">Add PDF</a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="ln_solid"></div>

                                    @include('email.fields.name')

                                    @include('email.fields.type')

                                    @include('email.fields.attachment')

                                    @include('email.fields.pdf_attachments')

                                    @include('email.fields.body')

                                    <div id="sample">
                                        <script type="text/javascript"
                                                src="/js/niceEdit-latest.js"></script>
                                        <script type="text/javascript">
                                            //<![CDATA[
                                            bkLib.onDomLoaded(function () {
                                                nicEditors.allTextAreas()
                                            });
                                            //]]>
                                        </script>
                                    </div>

                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                            <button type="submit" class="btn btn-success">Submit</button>
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