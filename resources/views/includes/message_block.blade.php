@if(count($errors) > 0)
    <div  style="text-align: center;" class="form-error danger">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
@if(Session::has('err'))
    <div  style="text-align: center" class="form-error alert-danger">
        <p>{{ session('err') }}</p>
    </div>
@endif

@if(Session::has('msg'))
    <div class="form-error alert-success" style="text-align: center;">
        <p>{{ Session::get('msg') }}</p>
    </div>
@endif