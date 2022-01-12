{{-- layout --}}
@extends('auth.layouts.app')

{{-- title --}}
@section('title', __('locale.Login'))

{{-- vendor-style --}}
@section('vendor-style')
@endsection

{{-- page-style --}}
@section('page-style')
    <link rel="stylesheet" type="text/css" href="{{asset('css/pages/login.css')}}">
@endsection

{{-- custom-css --}}
@section('custom-style')
@endsection

{{-- content --}}
@section('content')
    <div id="login-page" class="row">
        <div class="col s12 m6 l4 z-depth-4 card-panel border-radius-6 login-card bg-opacity-8">
            <form class="login-form" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="row">
                    <div class="input-field col s12">
                        <h5 class="ml-4">{{__('locale.Login')}}</h5>
                    </div>
                </div>
                <div class="row margin">
                    @if ($errors->has('email'))
                        <div class="card-alert card red">
                            <div class="card-content white-text" style="text-align: center;">
                                <p> {{ $errors->first('email') }}</p>
                            </div>
                        </div>
                    @endif
                    @if ($errors->has('password'))
                        <div class="card-alert card red">
                            <div class="card-content white-text" style="text-align: center;">
                                <p> {{ $errors->first('password') }}</p>
                            </div>
                        </div>
                    @endif
                    @if(Session::has('verify_success'))
                        <div class="card-alert card green">
                            <div class="card-content white-text" style="text-align: center;">
                                <p>{!! Session::get('verify_success')!!}</p>
                            </div>
                        </div>
                    @endif
                    @if(Session::has('verify_error'))
                        <div class="card-alert card red">
                            <div class="card-content white-text" style="text-align: center;">
                                <p> {!! Session::get('verify_error') !!}</p>
                            </div>
                        </div>
                    @endif
                    <div class="input-field col s12">
                        <i class="material-icons prefix pt-2">person_outline</i>
                        <input id="email" name="email" type="email" class="@error('email') is-invalid @enderror"
                               required autocomplete="email" autofocus>
                        <label for="email" class="center-align">{{__('locale.Mail')}}</label>
                    </div>
                </div>
                <div class="row margin">
                    <div class="input-field col s12">
                        <i class="material-icons prefix pt-2">lock_outline</i>
                        <input id="password" name="password" type="password"
                               class="@error('password') is-invalid @enderror" required
                               autocomplete="current-password">
                        <label for="password">{{__('locale.Password')}}</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 m12 l12 ml-2 mt-1">
                        <p>
                            <label>
                                <input id="remember" name="remember"
                                       type="checkbox" {{ old('remember') ? 'checked' : '' }} />
                                <span>{{__('locale.Remember Me')}}</span>
                            </label>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <button type="submit" class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12">
                            {{ __('locale.Login') }}
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6 m6 l6">
                        <p class="margin medium-small"><a href="{{url('/register')}}">{{__('locale.Register Now')}}</a></p>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

{{-- vendor-script --}}
@section('vendor-script')
@endsection

{{-- page-script --}}
@section('page-script')
@endsection
