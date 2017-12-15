@extends('layouts.admin')

@section('title')
    Sessions - Back Office
    @endsection

    @section('content')

            <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Sessions</h3>
                </div>

            </div>

            <div class="clearfix"></div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">

                    <div class="x_content">

                        <table id="datatable-checkbox" class="table table-striped table-bordered bulk_action">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Description</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Type of session</th>
                                <th>Where</th>
                                <th>Number of subscribers</th>
                            </tr>
                            </thead>


                            <tbody>
                            @foreach($sessions as $session)
                                <tr>
                                    <td>
                                        <a title="Edit the session" class="btn btn-info btn-xs" href="/session/edit/{{ $session->id }}"><i class="fa fa-pencil"></i></a>
                                        <a title="Delete session" class="btn btn-danger btn-xs" href="/session/delete/{{ $session->id }}"><i class="fa fa-trash"></i></a>
                                        <a title="Create student" class="btn btn-info btn-xs" href="/{{ $session->id }}/user/create"><i class="fa fa-share-square"></i></a>
                                    </td>
                                    <td>{{ $session->description }}</td>
                                    <td>{{ $session->getDate() }}</td>
                                    <td>{{ $session->time }}</td>
                                    <td>{{ $session->sessionType ? $session->sessionType->name : '' }}</td>
                                    <td>{{ $session->where }}</td>
                                    <td>{{ $session->max }}</td>
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