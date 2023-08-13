@extends('layouts.auth')

@section('page-title', trans('Login'))

@section('content')

    <div class="col-md-8 col-lg-6 col-xl-5 mx-auto my-10p" id="login">
        <div class="card mt-5">
            <div class="card-body">
                <div class="text-center">
                    <h2 class="text-header-color">AMIS Admin</h2>
                </div>
                <div class="p-2">
                    @include('partials.messages')

                    <form role="form" action="<?= url('login') ?>" method="POST" id="login-form" autocomplete="off"
                          class="mt-3">

                        <input type="hidden" value="<?= csrf_token() ?>" name="_token">

                        @if (Request::has('to'))
                            <input type="hidden" value="{{ Request::get('to') }}" name="to">
                        @endif

                        <div class="form-group">
                            <label for="username" class="sr-only">@lang('Email or Username')</label>
                            <input type="text"
                                   name="username"
                                   id="username"
                                   class="form-control input-solid"
                                   placeholder="@lang('Email or Username')"
                                   value="{{ old('username') }}">
                        </div>

                        <div class="form-group password-field">
                            <label for="password" class="sr-only">@lang('Password')</label>
                            <input type="password"
                                   name="password"
                                   id="password"
                                   class="form-control input-solid"
                                   placeholder="@lang('Password')">
                        </div>


                        @if (setting('remember_me'))
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="remember" id="remember"
                                       value="1"/>
                                <label class="custom-control-label font-weight-normal" for="remember">
                                    @lang('Remember me?')
                                </label>
                            </div>
                        @endif


                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary btn-lg btn-block" id="btn-login">
                                @lang('Login')
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@stop

@section('scripts')
    {!! HTML::script('assets/js/as/login.js') !!}
    {!! JsValidator::formRequest('Vanguard\Http\Requests\Auth\LoginRequest', '#login-form') !!}
@stop
