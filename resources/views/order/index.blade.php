@extends('layouts.admin')

@section('title')
    Subscriptions - Back Office
    @endsection

    @section('content')

            <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Subscriptions</h3>
                </div>
            </div>

            <div class="clearfix"></div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">

                    <div class="x_content">

                        <table class="table table-striped table-bordered bulk_action">
                            <thead>
                            <tr>
                                <th>
                                    <input type="checkbox" id="check-all" class="flat">
                                </th>
                                <th>Name</th>
                                <th>Surname</th>
                                <th>Fiscal code / <br /> Vat number</th>
                                <th>Personal Code</th>
                                <th>Matricola</th>
                                <th>Born in</th>
                                <th>Date of birth</th>
                                <th>Nation</th>
                                <th>Address</th>
                                <th>Street, Number</th>
                                <th>Province</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>University</th>
                                <th>School</th>
                                <th>Enrolment Exam</th>
                                <th>Session</th>
                            </tr>
                            </thead>




                            <tbody>
                            @foreach($orders as $order)
                                <tr
                                    @if($order->haveNotStudent())
                                        style="background-color: #5359ff; color: white;"
                                    @endif
                                >
                                    <th>
                                        <input type="checkbox" id="check-all" class="flat">
                                        <a title="{{ $order->getStudentBtnTitle() }}" style="margin-top:10px;" class="btn {{ $order->getCreateStudentBtnColor() }} btn-xs" href="{{ $order->getStudentLink() }}"><i class="fa fa-share-square"></i></a>
                                    </th>
                                    <td>{{ $order->name }}</td>
                                    <td>{{ $order->surname }}</td>
                                    <td>{{ $order->fiscal_code }} / {{ $order->vat }}</td>
                                    <td>{{ $order->personal_code }}</td>
                                    <td>{{ $order->matricola }}</td>
                                    <td>{{ $order->born_in }}</td>
                                    <td>{{ $order->date_of_birth }}</td>
                                    <td>{{ nation($order->nation) }}</td>
                                    <td>{{ $order->address }}</td>
                                    <td>{{ $order->street }}, {{ $order->number }}</td>
                                    <td>{{ province($order->province) }}</td>
                                    <td>{{ $order->phone }}</td>
                                    <td>{{ $order->email }}</td>
                                    <td>{{ university($order->university) }}</td>
                                    <td>{{ school($order->school) }}</td>
                                    <td>{{ $order->enrolment_exam }}</td>
                                    <td>{{ $order->session->description }}</td>
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