@extends('auth.layouts.app')

@section('title')
<title>Reset Password - {{ settings('app.name', 'ERMS') }} Management System</title>
@endsection

@section('content')

<!-- ////////////////////////////////////////////////////////////////////////////-->
<div class="app-content content container-fluid">
  <div class="content-wrapper">
    <div class="content-header row">
    </div>
    <div class="content-body"><section class="flexbox-container">
<div class="col-md-4 offset-md-4 col-xs-10 offset-xs-1 box-shadow-2 p-0">
    <div class="card border-grey border-lighten-3 px-2 py-2 m-0">
        <div class="card-header no-border pb-0">
            <div class="card-title text-xs-center">
                <a href="/"><img  src="/main/app-assets/images/logo/blocCentreLogo.png" alt="{{settings('APP_NAME')}}"></a>
            </div>
            <h6 class="card-subtitle line-on-side text-muted text-xs-center font-small-3 pt-2"><span>Reset your password.</span></h6>
        </div>
        <div class="card-body collapse in">
            <div class="card-block">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <form class="form-horizontal"  method="POST" action="{{ route('password.update') }}" novalidate>
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <fieldset class="form-group position-relative has-icon-left">
                        <input type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }} form-control-lg input-lg" id="user-email" name="email" value="{{ old('email') }}" placeholder="Your Email Address" required>
                        <div class="form-control-position">
                            <i class="icon-mail6"></i>
                        </div>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </fieldset>
                    <fieldset class="form-group {{ $errors->has('password') ? ' is-invalid' : '' }} position-relative has-icon-left mb-1">
                        <input type="password" class="form-control form-control-lg input-lg" id="user-password" placeholder="Enter New Password"  name="password" required>
                        <div class="form-control-position">
                            <i class="icon-key3"></i>
                        </div>
                        @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span> 
                        @endif
                    </fieldset>
                    <fieldset class="form-group position-relative has-icon-left mb-1">
                        <input type="password" class="form-control form-control-lg input-lg" id="user-password" placeholder="Confirm New Password"  name="password_confirmation" required>
                        <div class="form-control-position">
                            <i class="icon-key3"></i>
                        </div>
                    </fieldset>                    
                    <button type="submit" class="btn btn-blue btn-lg btn-block"><i class="icon-lock4"></i> {{ __('Reset Password') }}</button>
                </form>
            </div>
        </div>
        <div class="card-footer no-border">
            <p class="float-sm-left text-xs-center"><a href="{{ route('login') }}" class="card-link blue">{{ __('Login') }}</a></p>
            <p class="float-sm-right text-xs-center">New to {{settings('APP_NAME')}} ? <a href="{{ route('register') }}" class="card-link blue">Create Account</a></p>
        </div>
    </div>
</div>
</section>

    </div>
  </div>
</div>
<!-- ////////////////////////////////////////////////////////////////////////////-->

@endsection
