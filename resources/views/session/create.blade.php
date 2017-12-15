@extends('layouts.admin')

@section('title')
    Add session - Back Office
    @endsection

    @section('content')

            <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Add session</h3>
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
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Description <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input value="{{ old('description') ?: $session->description }}" type="text" id="description" name="description" required="required" class="form-control col-md-7 col-xs-12">
                                                @if ($errors->has('description'))
                                                    <div class="red-error form-error">
                                                        {{ $errors->first('description') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Date <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input value="{{ old('date') ? localDate(old('date')) : localDate($session->date) }}" type="date" id="date" name="date" required="required" class="form-control col-md-7 col-xs-12">
                                                @if ($errors->has('date'))
                                                    <div class="form-error red-error">
                                                        {{ $errors->first('date') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Time <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input value="{{ old('time') ?: $session->time }}" type="text" id="time" name="time" required="required" class="form-control col-md-7 col-xs-12">
                                                @if ($errors->has('time'))
                                                    <div class="red-error form-error">
                                                        {{ $errors->first('time') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Type of session</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <select class="form-control" name="session_type_id">
                                                    <option value="0">Type of session</option>
                                                    @foreach($sessionTypes as $type)
                                                        <option value="{{ $type->id }}"
                                                                @if($session->session_type_id == $type->id)
                                                                    selected="selected"
                                                                @endif
                                                        >{{ $type->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="where">Where <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input value="{{ old('where') ?: $session->where }}" type="text" id="where" name="where" required="required" class="form-control col-md-7 col-xs-12">
                                                @if ($errors->has('where'))
                                                    <div class="red-error form-error">
                                                        {{ $errors->first('where') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="where">Number of subscribers <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input value="{{ old('max') ?: $session->max }}" type="text" id="max" name="max" required="required" class="form-control col-md-7 col-xs-12">
                                                @if ($errors->has('max'))
                                                    <div class="red-error form-error">
                                                        {{ $errors->first('max') }}
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