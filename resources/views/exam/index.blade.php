@extends('layouts.admin')

@section('title')
    Exams - Back Office
    @endsection

    @section('content')

            <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            @include('includes.message_block')
            <div class="page-title">
                <div class="title_left">
                    <h3>Exams</h3>
                </div>
            </div>

            <div class="clearfix"></div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">

                    <div class="x_content">


                        <div class="clearfix"></div>
                        <form method="post" action="">
                            <div class="row form-group">
                                <div class="col-md-2">
                                    <input class="form-control" type="text" value="" name="price" placeholder="Price">
                                    @if ($errors->has('price'))
                                        <div class="red-error form-error">
                                            {{ $errors->first('price') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-2">
                                    <select class="form-control" name="session_type_id">
                                        <option value="0">Type of session</option>
                                        @foreach($sessionTypes as $type)
                                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <select class="form-control" name="course_type_id">
                                        <option value="0">Type of course</option>
                                        @foreach($courseTypes as $type)
                                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <input class="form-control" type="text" value="" name="variations" placeholder="Variations">
                                </div>
                                {{ csrf_field() }}
                                <div class="col-md-2">
                                    <button class="btn btn-primary" type="submit">Add</button>
                                </div>
                            </div>
                        </form>
                        <div class="clearfix"></div>

                        <hr>

                        <table id="datatable-checkbox" class="table table-striped table-bordered bulk_action">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Price, €</th>
                                <th>Type of session</th>
                                <th>Type of course</th>
                                <th>Variations</th>
                            </tr>
                            </thead>


                            <tbody>
                            @foreach($exams as $exam)
                                <tr>
                                    <td>
                                        <div style="display:inline-block;">
                                            <form method="get" action="/exam/{{ $exam->id }}/edit">
                                                <button type="submit" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i></button>
                                            </form>
                                        </div>
                                        <div style="display:inline-block;">
                                            <form method="get" action="/exam/{{ $exam->id }}/delete">
                                                <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                    <td>{{ $exam->price() }}</td>
                                    <td>{{ $exam->sessionType ? $exam->sessionType->name : '' }}</td>
                                    <td>{{ $exam->courseType ? $exam->courseType->name : '' }}</td>
                                    <td>{{ $exam->variations }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>


                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- /page content -->
@endsection