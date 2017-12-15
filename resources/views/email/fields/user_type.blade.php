<div class="form-group user_type">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="type">User type
    </label>

    <div class="col-md-6 col-sm-6 col-xs-12">
        <select name="user_type" id="user_type" class="form-control">
            @foreach($userTypes as $key => $value)
                <option
                        @if(isset($template->user_type))
                        @if($template->user_type == $key || old('user_type') == $key)
                        selected="selected"
                        @endif
                        @endif
                        value="{{ $key }}">{{ $value }}
                </option>
            @endforeach
        </select>
    </div>
</div>