<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Student;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function show(Invoice $invoice)
    {
        $pdf = \PDF::loadView('invoice.invoice', [
            'invoice' => $invoice
        ]);

        return $pdf->stream('invoice.pdf');
    }

    public function createAndShow(Student $student)
    {
        $invoice = new Invoice(array_merge($student->toArray(), [
            'id'         => $student->invoice_number_1,
            'student_id' => $student->id
        ]));
        $invoice->save();
        $pdf = \PDF::loadView('invoice.invoice', [
            'invoice' => $invoice
        ]);

        return $pdf->stream('invoice.pdf');
    }

    public function toeicShow(Invoice $invoice, Student $student)
    {
        $invoice->description = $invoice->description($student);
        $pdf = \PDF::loadView('invoice.invoice', [
            'invoice' => $invoice
        ]);

        return $pdf->stream('invoice.pdf');
    }

    public function toeicCreateAndShow(Student $student)
    {
        $invoice = new Invoice(array_merge($student->toArray(), [
            'id'         => $student->invoice_number_1,
            'student_id' =>$student->id
        ]));
        $invoice->description = $invoice->description($student);
        $invoice->save();
        $pdf = \PDF::loadView('invoice.invoice', [
            'invoice' => $invoice
        ]);

        return $pdf->stream('invoice.pdf');
    }

    public function html(Invoice $invoice)
    {
        return view('invoice.invoice', [
            'invoice' => $invoice
        ]);
    }

    public function index()
    {
        $invoices = Invoice::orderBy('send_at', 'desc')->get();

        return view('invoice.index', compact('invoices'));
    }

    public function destroy(Invoice $invoice)
    {
        $invoice->delete();

        return redirect()->back()->withMsg('Successfully deleted.');
    }

    public function edit(Invoice $invoice)
    {
        return view('invoice.edit', compact('invoice'));
    }

    public function update(Invoice $invoice, Request $request)
    {
        $invoice->update($request->all());

        return redirect()->route('invoice.index')->withMsg('Successfully updated.');
    }
}
