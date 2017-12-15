@extends('layouts.admin')

@section('title')
    Invoices - Back Office
    @endsection

    @section('content')

            <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Invoices</h3>
                </div>

            </div>

            <div class="clearfix"></div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">

                    <div class="x_content">

                        <div class="clearfix"></div>

                        <table id="datatable-checkbox1" class="table table-striped table-bordered bulk_action">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Fiscal Code</th>
                                <th>email</th>
                                <th>Name</th>
                                <th>Surname</th>
                                <th>City</th>
                                <th>Street</th>
                                <th>Number</th>
                                <th>Description</th>
                                <th>Total</th>
                                <th>Send date</th>
                            </tr>
                            </thead>


                            <tbody>
                            @foreach($invoices as $invoice)
                                <tr>
                                    <td>
                                        <div style="display:inline-block;">
                                            <a target="_blank" href="/invoice/{{ $invoice->id }}/show" class="btn btn-info btn-xs" title="Show   the invoice"><i class="fa fa-eye"></i></a>
                                            <a href="/invoice/{{ $invoice->id }}/edit" class="btn btn-info btn-xs"><i class="fa fa-pencil"  title="Edit the invoice"></i></a>
                                            <a href="/invoice/{{ $invoice->id }}/delete" class="btn btn-danger btn-xs"><i class="fa fa-trash"  title="Delete the invoice"></i></a>
                                            <a href="#" onclick="sendInvoice({{ $invoice->id }}); return false;" class="btn btn-success btn-xs"><i class="fa fa-mail-forward"  title="Send again"></i></a>
                                            <br>
                                            <span id="invoice-result_{{ $invoice->id }}"></span>
                                        </div>
                                    </td>
                                    <td>{{ $invoice->fiscal_code }}</td>
                                    <td>{{ $invoice->email }}</td>
                                    <td>{{ $invoice->name }}</td>
                                    <td>{{ $invoice->surname }}</td>
                                    <td>{{ city($invoice->city_id) }}</td>
                                    <td>{{ $invoice->street }}</td>
                                    <td>{{ $invoice->number }}</td>
                                    <td>{{ $invoice->description }}</td>
                                    <td>{{ $invoice->total }}</td>
                                    <td>{{ $invoice->send_at ? $invoice->send_at->timezone('GMT+2')->format('d/m/Y H:i') : '' }}</td>
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
    <!-- jQuery -->
    <script src="/bower_components/gentelella/vendors/jquery/dist/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#datatable-checkbox1').DataTable({
                "ordering": false
            });
        });

        function sendInvoice(invoiceId) {
            var resEl = $('span#invoice-result_' + invoiceId);
            resEl.html('sending...');
            resEl.css('color', 'green');
            $.ajax({
                url: "/api/email/invoice/send/" + invoiceId,
                method: "POST",
                success: function (data) {
                    if (data.success == true) {
                        resEl.html('success');
                    }
                },
                error: function () {
                    console.log('error send invoice');
                    resEl.html('error');
                    resEl.css('color', 'red');
                }
            })
        }
    </script>
@endsection