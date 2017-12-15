<div class="form-group attachment">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="type">PDF attachments
    </label>

    <div class="col-md-6 col-sm-6 col-xs-12">
        @foreach($template->pdfAttachments as $pdf)
            <p><a class="btn btn-xs alert-danger" href="/pdf/{{ $pdf->id }}/delete">delete</a> <a class="btn btn-xs alert-success" href="/pdf/{{ $pdf->id }}/edit">edit</a> {{ $pdf->name }}</p><br>
        @endforeach
    </div>
</div>