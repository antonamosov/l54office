<div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="type">Type
        <span class="required">*</span>
    </label>

    <div class="col-md-6 col-sm-6 col-xs-12">
        <select name="type" id="type" class="form-control">
            @foreach(config('email_types') as $key => $type)
                <option
                        @if(isset($template->type))
                        @if($template->type == $key)
                        selected="selected"
                        @endif
                        @else
                        @if(old('type') == $key)
                        selected="selected"
                        @endif
                        @endif
                        value="{{ $key }}">{{ $type }}</option>
            @endforeach
        </select>
    </div>
</div>