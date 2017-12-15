@extends('layouts.admin')

@section('title')
    Session types - Back Office
    @endsection

    @section('content')

            <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Session types</h3>
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
                                    <input class="form-control" type="text" value="{{ old('name') }}" name="name" placeholder="Name">
                                    @if ($errors->has('name'))
                                        <div class="red-error form-error">
                                            {{ $errors->first('name') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-2">
                                    <textarea class="form-control" name="description" placeholder="Description">{{ old('description') }}</textarea>
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
                                <th>Name</th>
                                <th>Description</th>
                            </tr>
                            </thead>


                            <tbody>
                            @foreach($types as $type)
                                <tr>
                                    <td>
                                        <div style="display:inline-block;">
                                            <form method="get" action="/session/type/{{ $type->id }}/delete">
                                                <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                    <td>{{ $type->name }}</td>
                                    <td>{{ $type->description ?: '' }}</td>
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