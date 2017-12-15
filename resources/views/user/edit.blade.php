@extends('layouts.admin')

@section('title')
    Users - Back Office
@endsection

@section('content')

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            @include('includes.message_block')
            <div class="page-title">
                <div class="title_left">
                    <h3>Users</h3>
                </div>
            </div>

            <div class="clearfix"></div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">

                    <div class="x_content">

                        <hr>

                        <div class="col-md-8 col-md-offset-2">
                            <form method="post" action="">
                                <div class="row form-group">
                                    <div class="col-md-12 form-group">
                                        <input class="form-control" type="text" value="{{ old('name') ?: $user->name }}" name="name" placeholder="Name">
                                        @if ($errors->has('name'))
                                            <div class="red-error form-error">
                                                {{ $errors->first('name') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <input class="form-control" type="email" value="{{ old('email') ?: $user->email }}" name="email" placeholder="Email">
                                        @if ($errors->has('email'))
                                            <div class="red-error form-error">
                                                {{ $errors->first('email') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <input class="form-control" type="password" value="" name="password" placeholder="Password">
                                        @if ($errors->has('password'))
                                            <div class="red-error form-error">
                                                {{ $errors->first('password') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <input class="form-control" type="password" value="" name="confirm_password" placeholder="Confirm password">
                                        @if ($errors->has('confirm_password'))
                                            <div class="red-error form-error">
                                                {{ $errors->first('confirm_password') }}
                                            </div>
                                        @endif
                                    </div>
                                    {{ csrf_field() }}
                                    <div style="text-align: right;" class="col-md-12 form-group">
                                        <button class="btn btn-primary" type="submit">Add</button>
                                    </div>
                                </div>
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