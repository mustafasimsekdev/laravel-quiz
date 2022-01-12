{{-- layout --}}
@extends('auth.layouts.app')

{{-- title --}}
@section('title', __('locale.Register Now'))

{{-- vendor-style --}}
@section('vendor-style')
@endsection

{{-- page-style --}}
@section('page-style')
    <link rel="stylesheet" type="text/css" href="{{asset('css/pages/register.min.css')}}">
@endsection

{{-- custom-css --}}
@section('custom-style')
@endsection

{{-- content --}}
@section('content')
    <div id="register-page" class="row">
        <div class="col s12 m6 l4 z-depth-4 card-panel border-radius-6 register-card bg-opacity-8">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="row">
                    <div class="input-field col s12">
                        <h5 class="ml-4">{{__('locale.Register Now')}}</h5>
                        <p class="ml-4">{{__('locale.Join to our community now')}}</p>
                    </div>
                </div>
                <div class="row margin">
                    @if ($errors->has('fullname'))
                        <div class="card-alert card red">
                            <div class="card-content white-text" style="text-align: center;">
                                <p> {{ $errors->first('fullname') }}</p>
                            </div>
                        </div>
                    @endif
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
                    @if ($errors->has('password-confirm'))
                        <div class="card-alert card red">
                            <div class="card-content white-text" style="text-align: center;">
                                <p> {{ $errors->first('password-confirm') }}</p>
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
                        <input id="fullname" type="text" class="form-control @error('fullname') is-invalid @enderror"
                               name="fullname" value="{{ old('fullname') }}" required autocomplete="name">
                        <label for="fullname" class="center-align">{{__('locale.Full Name')}}</label>
                    </div>
                </div>
                <div class="row margin">
                    <div class="input-field col s12">
                        <i class="material-icons prefix pt-2">mail_outline</i>
                        <input id="email" name="email" type="email" class="@error('email') is-invalid @enderror"
                               required autocomplete="email">
                        <label for="email" class="center-align">{{__('locale.Mail')}}</label>
                    </div>
                </div>
                <div class="row margin">
                    <div class="input-field col s12">
                        <i class="material-icons prefix pt-2">lock_outline</i>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                        <label for="password">{{__('locale.Password')}}</label>
                    </div>
                </div>
                <div class="row margin">
                    <div class="input-field col s12">
                        <i class="material-icons prefix pt-2">lock_outline</i>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        <label for="password-confirm">{{ __('locale.Confirm Password') }}</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <button type="submit" class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12">
                            {{ __('locale.Register') }}
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <p class="margin medium-small"><a href="{{url('/login')}}">{{__('locale.Already have an account')}}
                                {{__('locale.Login')}}</a></p>
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
