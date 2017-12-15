<div class="form-group attachment">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="type">Attachments
    </label>

    <div class="col-md-6 col-sm-6 col-xs-12">
        @foreach($template->attachments as $attachment)
            <p><a class="btn btn-xs alert-danger" href="/attachment/{{ $attachment->id }}/delete">delete</a> {{ $attachment->name }}</p><br>
        @endforeach
        <input type="file" name="attachment">
    </div>
</div>