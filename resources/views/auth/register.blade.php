<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>FindProperty | Register</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ url('/')}}/plugins/fontawesome-free/css/all.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('/')}}/dist/css/adminlte.min.css">


        <link rel="stylesheet" href="{{ url('/')}}/bootstrap/css/bootstrap.min.css">
        {{-- <link rel="stylesheet" href="{{ url('/')}}/assets/css/style.css">
        <link rel="stylesheet" href="{{ url('/')}}/assets/css/responsive.css"> --}}
    <style>
        label{
            font-size: 10px !important;

        }
    </style>
</head>
<body class="hold-transition login-page my-5">
    <div class="login-box">
        <div class="login-logo">
            <a href="{{ url('/') }}">
                <img src="{{ url('/')}}/img/logo2.png" width="70%">
            </a>
        </div>
        <div class="card card-body">
            <div class="overflow">
                <div class="col-md-12 col-xs-12 login-blocks">
                    <h5 class="text-center">Register Account </h5>
                    <form action="{{ route('registration.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="fname">First Name</label>
                            <input id="fname" type="text" class="form-control  @error('first name') is-invalid @enderror" name="fname" value="{{ old('fname') }}" required>
                            @error('first name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="lname">Last Name</label>
                            <input id="lname" type="text" class="form-control  @error('last name') is-invalid @enderror" name="lname" value="{{ old('lname') }}" required >
                            @error('last name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email"type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">{{ __('Password') }} (must have an 8 characters or more)</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password-confirm">{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                        <div class="form-group">
                            <label for="agency">Client Type</label>
                            <select class="form-control" id="agency" name="role_type" required>
                                @foreach ($roles as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->role_type }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        {{-- <div class="form-group agency_hide agency_1 ">
                            <label for="agency_name">Agency Name</label>
                            <input id="agency_name" type="text" class="form-control @error('agency') is-invalid @enderror" name="agency_name" >

                            @error('agency')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group agency_hide agency_1 ">
                            <label for="angency_address">Address</label>
                            <input id="agency_address" type="text" class="form-control" name="agency_address" >

                            @error('agency_address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group agency_hide agency_1 ">
                            <label for="office">Office Number </label>
                            <input id="office_no" type="tel" class="form-control" name="office_no" >

                            @error('office_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div> --}}
                        <input type='submit' class='btn btn-sm btn-block btn-primary ' value='Finish' />
                        <div class="modal-footer justify-content-between">

                            <p class="mb-0" style="font-size: 10px !important;">Already a member?
                                <a href="{{ route('login') }}"> Login</a>
                            </p>

                        </div>

                    </form><!-- /.tab-content -->
                </div>

            </div>
        </div>
    </div>

<!-- jQuery -->


        <script src="{{ url('/')}}/assets/js/jquery-1.10.2.min.js"></script>
        <script src="{{ url('/')}}/bootstrap/js/bootstrap.min.js"></script>

        <script src="{{ url('/')}}/assets/js/jquery.validate.min.js"></script>

        {{-- <script src="{{ url('/')}}/assets/js/main.js"></script> --}}
        <script>
            //add collapse to all tags hiden and showed by select mystuff
            $('.agency_hide').addClass('collapse');

            //on change hide all divs linked to select and show only linked to selected option
            $('#agency').change(function(){
                //Saves in a variable the wanted div
                var selector = '.agency_' + $(this).val();

                //hide all elements
                $('.agency_hide').collapse('hide');

                //show only element connected to selected option
                $(selector).collapse('show');
                $("#agency_name").attr("required", true);
                $("#agency_address").attr("required", true);
                $("#office_no").attr("required", true);
            });
        </script>
</body>
</html>
