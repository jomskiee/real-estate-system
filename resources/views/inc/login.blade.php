<!-- Modal -->
<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Login : </h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="overflow">
                    <div class="col-md-12 col-xs-12 login-blocks">

                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input  type="text" class="form-control  @error('email') is-invalid @enderror"  name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input  type="password" class="form-control  @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="icheck-primary">
                                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label for="remember">Remember Me</label>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-block btn-primary"> Log in</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                @if (Route::has('password.request'))
                    <p class="mb-0">
                        <a href="{{ route('password.request') }}">I forgot my password</a>
                    </p>
                @endif
                <p class="mb-0">
                    {{-- <a href="" role="button" class="text-center" data-toggle="modal" data-target="#register" data-dismiss="modal">Register a new membership</a> --}}
                    <a href="{{ route('register') }}"> Register a new membership</a>
                </p>
            </div>
        </div>
    </div>
</div>
<!-- register Modal -->
<div class="modal fade" id="register" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style=" height:600px ; overflow-y: scroll; ">

            <div class="modal-header">
                <h4>New account : </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="overflow">
                    <div class="col-md-12 col-xs-12">

                        <form action="{{ route('register') }}" method="POST">
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
                            <label for="agency">Client Type</label>
                            <select class="form-control" id="agency" name="client_type" required>
                                <option value="1">Private</option>
                                <option value="2">Agent</option>
                            </select>
                            <div class="form-group">
                                <label for="password">{{ __('Password') }} (must have an 8 characters or more)</label>
                                <input  type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

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
                            <div class="text-center">
                                <button type="submit" class="btn  btn-block btn-primary">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer mt-4">
                    <p class="mb-0">Already a member?
                        <a href="#" role="button" class="text-center" data-toggle="modal" data-target="#login" data-dismiss="modal"> Login</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>




