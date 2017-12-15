@extends('layouts.admin')

@section('title')
    Edit invoice - Back Office
    @endsection

    @section('content')

            <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Edit invoice</h3>
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
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fiscal_code">Fiscal Code
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input value="{{ old('fiscal_code') ?: $invoice->fiscal_code }}" type="text" id="fiscal_code" name="fiscal_code" class="form-control col-md-7 col-xs-12">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input value="{{ old('email') ?: $invoice->email }}" type="text" id="email" name="email" class="form-control col-md-7 col-xs-12">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input value="{{ old('name') ?: $invoice->name }}" type="text" id="name" name="name" class="form-control col-md-7 col-xs-12">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="surname">Surname
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input value="{{ old('surname') ?: $invoice->surname }}" type="text" id="surname" name="surname" class="form-control col-md-7 col-xs-12">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="city_id">City
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select name="city_id" id="city_id" class="form-control col-md-7 col-xs-12">
                                                @foreach(config('cities') as $key => $city)
                                                    <option
                                                            @if($invoice->city_id == $key)
                                                            selected="selected"
                                                            @endif
                                                            value="{{ $key }}">{{ $city }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="street">Street
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input value="{{ old('street') ?: $invoice->street }}" type="text" id="street" name="street" class="form-control col-md-7 col-xs-12">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Number
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input value="{{ old('number') ?: $invoice->number }}" type="text" id="number" name="number" class="form-control col-md-7 col-xs-12">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Description
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <textarea type="text" id="description" name="description" class="form-control col-md-7 col-xs-12">{{ old('description') ?: $invoice->description }}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sum">Sum
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input value="{{ old('sum') ?: $invoice->sum }}" type="text" id="sum" name="sum" class="form-control col-md-7 col-xs-12">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="total">Total
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input value="{{ old('total') ?: $invoice->total }}" type="text" id="total" name="total" class="form-control col-md-7 col-xs-12">
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