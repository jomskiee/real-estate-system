<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>FindProperty | Reset Password</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ url('/')}}/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ url('/')}}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('/')}}/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="{{ url('/')}}/assets/css/style.css">
    <link rel="stylesheet" href="{{ url('/')}}/assets/css/fontello.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="{{ url('/') }}">
            <img src="{{ url('/')}}/img/logo2.png" width="70%">
        </a>
    </div>
    <div class="card card-body">
        <div class="overflow">
            <div class="col-md-12 col-xs-12 login-blocks">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <h2>Reset Password : </h2>
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="form-group mt-3">
                        <label for="email">{{ __('E-Mail Address') }}</label>
                        <input id="email" type="email" class="form-control  @error('email') is-invalid @enderror"  name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="text-center mt-5">
                        <button type="submit" class="btn btn-block btn-default"> {{ __('Send Password Reset Link') }}</button>
                    </div>
                </form>
                <hr class="mt-5">
                @if (Route::has('password.request'))
                        <a href="{{ url('/') }}" class="float-right mt-1"><label for="forgot_password">Go back</label> </a>
                @endif
            </div>

        </div>
    </div>
</div>

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
</body>
</html>
