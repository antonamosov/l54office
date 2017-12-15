<div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Name
        <span class="required">*</span>
    </label>

    <div class="col-md-6 col-sm-6 col-xs-12">
        <input class="form-control" type="text"
               value="{{ old('name') ?: $template->name }}" name="name">
        @if ($errors->has('name'))
            <div class="red-error form-error">
                {{ $errors->first('name') }}
            </div>
        @endif
    </div>
</div>