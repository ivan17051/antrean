@extends('layouts.tvbase')

@section('content')

<div class="login">

<!-- Login -->
<div class="login__block active" id="l-login">
    <div class="login__block__header">
        <i class="zmdi zmdi-account-circle"></i>
        Silahkan Login

        <div class="actions actions--inverse login__block__actions">
            <div class="dropdown">
                <i data-toggle="dropdown" class="zmdi zmdi-more-vert actions__item"></i>

                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="{{url('/register')}}">Buat Akun</a>
                    <a class="dropdown-item" data-ma-action="login-switch" data-ma-target="#l-forget-password" href="">Lupa password?</a>
                </div>
            </div>
        </div>
    </div>

    <div class="login__block__body">
        <div class="form-group form-group--float form-group--centered">
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            <label>Alamat Email</label>
            <i class="form-group__bar"></i>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group form-group--float form-group--centered">
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
            <label>Password</label>
            <i class="form-group__bar"></i>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <button href="{{url('/')}}" class="btn btn--icon login__block__btn"><i class="zmdi zmdi-long-arrow-right"></i></button>
    </div>
</div>

<!-- Forgot Password -->
<div class="login__block" id="l-forget-password">
    <div class="login__block__header palette-Purple bg">
        <i class="zmdi zmdi-account-circle"></i>
        Lupa Password?

        <div class="actions actions--inverse login__block__actions">
            <div class="dropdown">
                <i data-toggle="dropdown" class="zmdi zmdi-more-vert actions__item"></i>

                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" data-ma-action="login-switch" data-ma-target="#l-login" href="">Sudah Punya Akun?</a>
                    <a class="dropdown-item" href="{{url('/register')}}">Buat Akun</a>
                </div>
            </div>
        </div>
    </div>

    <div class="login__block__body">
        <p class="mt-4">Masukkan alamat email anda.</p>

        <div class="form-group form-group--float form-group--centered">
            <input type="text" class="form-control">
            <label>Alamat Email</label>
            <i class="form-group__bar"></i>
        </div>

        <button href="index.html" class="btn btn--icon login__block__btn"><i class="zmdi zmdi-check"></i></button>
    </div>
</div>
</div>


<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> -->
@endsection
