@extends('layouts.admin')

@section('title')
    Emails - Back Office
    @endsection

    @section('content')

            <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Emails</h3>
                </div>

            </div>

            <div class="clearfix"></div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">

                    <div class="x_content">

                        <div class="clearfix"></div>

                        <table id="datatable-checkbox" class="table table-striped table-bordered bulk_action">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Dynamic PDF templates attached</th>
                                <th>Files attached</th>
                            </tr>
                            </thead>


                            <tbody>
                            @foreach($emails as $email)
                                <tr>
                                    <td>
                                        <div style="display:inline-block;">
                                            <form method="get" action="/email/{{ $email->id }}/edit">
                                                <button type="submit" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i></button>
                                            </form>
                                        </div>
                                        <div style="display:inline-block;">
                                            <form method="get" action="/email/{{ $email->id }}/delete">
                                                <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                    <td>{{ $email->name }}</td>
                                    <td>{{ emailType($email->type) }}</td>
                                    <td>{{ $email->pdfsStringList() }}</td>
                                    <td>{{ $email->attachesStringList() }}</td>
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