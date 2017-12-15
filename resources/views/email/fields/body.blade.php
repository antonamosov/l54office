<div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Body
        <span class="required">*</span>
    </label>

    <div class="col-md-6 col-sm-6 col-xs-12">
                                            <textarea class="form-control"
                                                      name="body">{{ old('body') ?: $template->body }}</textarea>
        @if ($errors->has('body'))
            <div class="red-error form-error">
                {{ $errors->first('body') }}
            </div>
        @endif
    </div>

    <div class="col-md-3 col-sm-3 col-xs-12 rules" style="border:1px solid rgb(204, 204, 204);">
        @foreach($variables as $var)
            <p>{{ '{' . $var['name'] . '}' }} - {{ $var['description'] }}</p>
        @endforeach
    </div>
</div>