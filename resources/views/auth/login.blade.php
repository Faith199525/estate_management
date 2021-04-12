@extends('auth.layouts.app')

@section('title')
<title>Login - {{ settings('app.name', 'ERMS') }} Management System</title>
@endsection

@section('content')

<!-- ////////////////////////////////////////////////////////////////////////////-->
<div class="app-content content container-fluid">
  <div class="content-wrapper">
    <div class="content-header row">
    </div>
    <div class="content-body">
        <section class="flexbox-container">
            <div class="col-md-4 offset-md-4 col-xs-10 offset-xs-1  box-shadow-2 p-0">
                <div class="card border-grey border-lighten-3 m-0">
                    <div class="card-header no-border">
                        <div class="card-title text-xs-center">
                            <div class="p-1">
                                <a href="/"><img  src="/main/app-assets/images/logo/blocCentreLogo.png" alt="{{settings('APP_NAME')}}"></a>
                            </div>
                        </div>
                        <h6 class="card-subtitle line-on-side text-muted text-xs-center font-small-3 "><span>{{ __('Login') }} to {{settings('APP_NAME')}}</span></h6>
                    </div>
                    <div class="card-body collapse in">
                        <div class="card-block">
                            <form class="form-horizontal form-simple" method="POST" action="{{ route('login') }}" novalidate>
                                @csrf
                                <fieldset class="form-group position-relative has-icon-left mb-0">
                                    <input type="text" class="form-control form-control-lg input-lg {{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" placeholder="Your Email" name="email" value="{{ old('email') }}" required autofocus>
                                    <div class="form-control-position">
                                        <i class="icon-envelope"></i>
                                    </div>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                                </fieldset>
                                <fieldset class="form-group position-relative has-icon-left">
                                    <input type="password" class="form-control form-control-lg input-lg {{ $errors->has('password') ? ' is-invalid' : '' }}" id="user-password" placeholder="Enter Password" name="password" required>
                                    <div class="form-control-position">
                                        <i class="icon-key3"></i>
                                    </div>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                                </fieldset>
                                <fieldset class="form-group row">
                                    <div class="col-md-6 col-xs-12 text-xs-center text-md-left">
                                        <fieldset>
                                            <input type="checkbox" class="chk-remember" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label for="remember"> {{ __('Remember Me') }}</label>
                                        </fieldset>
                                    </div>
                                    @if (Route::has('password.request'))
                                    <div class="col-md-6 col-xs-12 text-xs-center text-md-right"><a href="{{ route('password.request') }}" class="card-link blue">{{ __('Forgot Your Password?') }}</a></div>
                                    @endif
                                </fieldset>
                                <button type="submit" class="btn btn-blue btn-lg btn-block"><i class="icon-unlock2"></i> {{ __('Login') }}</button>
                            </form>
                        </div>
                    </div>
                    @if (Route::has('register') && \Session::has('invite-key'))
                    <div class="card-footer">
                        <div class="">
                            <p class="float-sm-right text-xs-center m-0">New to {{settings('APP_NAME')}}? <a href="{{ route('register') }}" class="card-link">Sign Up</a></p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </section>

    </div>
  </div>
</div>
<!-- ////////////////////////////////////////////////////////////////////////////-->


@endsection
