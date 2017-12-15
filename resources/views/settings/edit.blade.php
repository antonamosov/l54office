@extends('layouts.admin')

@section('title')
    Settings - Back Office
@endsection

@section('content')

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Settings</h3>
                </div>

            </div>

            <div class="clearfix"></div>


            <div class="x_panel">

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_content">
                                <br />
                                <form method="post" action="" class="form-horizontal form-label-left">

                                    <div class="form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="first-name">Cron interval for expired emails (days hours:minutes - 03 05:15) <span class="required">*</span>
                                        </label>
                                        <div class="col-md-5 col-sm-5 col-xs-12">
                                            <input value="{{ old('cron_expired_interval') ?: (isset($settings->cron_expired_interval) ? $settings->cron_expired_interval : '') }}" type="text" placeholder="03 05:15" id="cron_expired_interval" name="cron_expired_interval" required="required" class="form-control col-md-7 col-xs-12">
                                            @if ($errors->has('cron_expired_interval'))
                                                <div class="red-error form-error">
                                                    {{ $errors->first('cron_expired_interval') }}
                                                </div>
                                            @endif
                                        </div>
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