@extends('auth.layouts.app')

@section('title')
<title>Register - {{ settings('app.name', 'ERMS') }} Management System</title>
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
        <div class="card-header no-border">
            <div class="card-title text-xs-center">
                <a href="/"><img  src="/main/app-assets/images/logo/blocCentreLogo.png" alt="{{settings('APP_NAME')}}"></a>
            </div>
            <h6 class="card-subtitle line-on-side text-muted text-xs-center font-small-3 pt-2"><span>Create Account</span></h6>
        </div>
        <div class="card-body collapse in">
            <div class="card-block">
                @if (\Session::has('invite-key'))
                <div class="text-center" style="margin-bottom:1em; color:green;">
                    Kindly use the same email that your invite was sent to.
                </div>

                <form class="form-horizontal form-simple" method="POST" action="{{ route('register') }}" novalidate>
                    @csrf
                    <fieldset class="form-group {{ $errors->has('name') ? ' is-invalid' : '' }}  position-relative has-icon-left mb-1">
                        <input type="text" class="form-control form-control-lg input-lg" id="name" placeholder="Full Name"  name="name" value="{{ old('name') }}" required autofocus>
                        <div class="form-control-position">
                            <i class="icon-head"></i>
                        </div>
                        @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                        @endif
                    </fieldset>
                    <fieldset class="form-group {{ $errors->has('email') ? ' is-invalid' : '' }} position-relative has-icon-left mb-1">
                        <input type="email" class="form-control form-control-lg input-lg" id="user-email" placeholder="Your Email Address"  name="email" value="{{ old('email') }}" required>
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
                        <input type="password" class="form-control form-control-lg input-lg" id="user-password" placeholder="Enter Password"  name="password" required>
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
                        <input type="password" class="form-control form-control-lg input-lg" id="user-password" placeholder="Confirm Password"  name="password_confirmation" required>
                        <div class="form-control-position">
                            <i class="icon-key3"></i>
                        </div>
                    </fieldset>
                    <button type="submit" class="btn btn-blue btn-lg btn-block"><i class="icon-unlock2"></i> {{ __('Register') }}</button>
                </form>
                @else
                <div class="text-xs-center">
                    You have to be invited to create an account.
                </div>
                @endif
            </div>
            <p class="text-xs-center">Already have an account ? <a href="{{ route('login') }}" class="card-link blue">{{ __('Login') }}</a></p>
        </div>
    </div>
</div>
</section>
    </div>
  </div>
</div>
<!-- ////////////////////////////////////////////////////////////////////////////-->


@endsection
