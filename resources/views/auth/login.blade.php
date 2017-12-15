<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Back Office</title>

    <!-- Bootstrap -->
    <link href="/bower_components/gentelella/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="/bower_components/gentelella/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="/bower_components/gentelella/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="/bower_components/gentelella/vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="/bower_components/gentelella/build/css/custom.min.css" rel="stylesheet">
</head>

<body class="login">
<div>
    <a class="hiddenanchor" id="signup"></a>
    <a class="hiddenanchor" id="signin"></a>

    <div class="login_wrapper">
        <div class="animate form login_form">
            <section class="login_content">
                <form  role="form" method="post" action="">

                    <h1>Login Form</h1>

                    <div class="alert-danger" style="margin-bottom: 20px">
                        @if(\Session::has('flash_message_important'))
                            {{ \Session::get('flash_message_important') }}
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <input type="text" name="email" class="form-control" placeholder="Username" required="" {{ old('email') }} />
                        @if ($errors->has('email'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <input type="password" name="password" class="form-control" placeholder="Password" required="" />
                        @if ($errors->has('password'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div>
                        <button class="btn btn-default submit">Log in</button>
                        <a class="reset_pass" href="{{ route('password.request') }}">Lost your password?</a>
                    </div>

                    {{ csrf_field() }}

                    <div class="clearfix"></div>

                    <div class="separator">
                        <div>
                            <h1><i class="fa fa-paw"></i> Back Office</h1>
                            <p>©2016 All Rights Reserved. Back office is a school app</p>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>
</body>
</html>
