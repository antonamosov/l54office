@extends('layouts.admin')

@section('title')
    Add session - Back Office
    @endsection

    @section('content')

            <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            @include('includes.message_block')
            <div class="page-title">
                <div class="title_left">
                    <h3>Edit exam</h3>
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
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Price <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input value="{{ old('price') ?: $exam->price() }}" type="text" id="price" name="price" required="required" class="form-control col-md-7 col-xs-12">
                                            @if ($errors->has('price'))
                                                <div class="red-error form-error">
                                                    {{ $errors->first('price') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Type of session <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select class="form-control" name="session_type_id">
                                                <option value="0">Type of session</option>
                                                @foreach($sessionTypes as $type)
                                                    <option value="{{ $type->id }}"
                                                            @if($exam->session_type_id == $type->id)
                                                                selected="selected"
                                                            @endif
                                                    >{{ $type->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Type of course <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select class="form-control" name="course_type_id">
                                                <option value="0">Type of course</option>
                                                @foreach($courseTypes as $type)
                                                    <option value="{{ $type->id }}"
                                                            @if($exam->course_type_id == $type->id)
                                                                selected="selected"
                                                            @endif
                                                    >{{ $type->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Variations
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input value="{{ old('variations') ?: $exam->variations }}" type="text" id="variations" name="variations" required="required" class="form-control col-md-7 col-xs-12">
                                            @if ($errors->has('variations'))
                                                <div class="red-error form-error">
                                                    {{ $errors->first('variations') }}
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