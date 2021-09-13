<!DOCTYPE html>
<html lang="en">

<head>
	<title>Login - DSD</title>
	@include('_includes/head')
</head>

<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="#">
                                <img src="images/icon/logo.png" alt="CoolAdmin">
                            </a>
                        </div>
                        <div class="login-form">
							<form method="post" method="POST" action="{{ route('login') }}">
								@csrf
                                <div class="form-group">
                                    <label>Email Address</label>
									<input class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" type="email" name="email" placeholder="Email" value="{{ old('email') }}" autofocus required>
									@if ($errors->has('email'))
										<span class="invalid-feedback">{{ $errors->first('email') }}</span>
									@endif
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
									<input class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" name="password" placeholder="Password" required>
									@if ($errors->has('password'))
									<span class="invalid-feedback">{{ $errors->first('password') }}</span>
									@endif
                                </div>
                                <div class="login-checkbox">
                                    {{-- <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>Remember Me
                                    </label>
                                    <label>
                                        <a href="#">Forgotten Password?</a>
                                    </label> --}}
                                </div>
                                <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">sign in</button>
                            </form>
                            {{-- <div class="register-link">
                                <p>
                                    Don't you have account?
                                    <a href="{{ route('register') }}">Sign Up Here</a>
                                </p>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('_includes/scripts')
</body>
</html>

