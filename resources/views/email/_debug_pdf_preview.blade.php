@if(\Illuminate\Support\Facades\Input::get('debug') == 1)
    <div class="form-group preview">
        <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-12">
            <select id="user_id">
                @foreach(\App\Student::orderBy('id', 'desk')->take(10)->get() as $u)
                    <option value="{{ $u->id }}">{{ $u->name . ' ' . $u->surname }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group preview">
        <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-12">
            <a target="_blank" id="debug-pdf-preview" href="pdf/preview/">Preview PDF (debug, please save firstly)</a>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            var userIdEl = $('select#user_id');
            setPdfPreviewLink(userIdEl.val());
            userIdEl.change(function() {
                setPdfPreviewLink($(this).val());
            });
            function setPdfPreviewLink(id) {
                $('a#debug-pdf-preview').attr('href', '/email/' + {{ $email->id }} + '/pdf/preview/' + id);
            }
        });
    </script>
@endif