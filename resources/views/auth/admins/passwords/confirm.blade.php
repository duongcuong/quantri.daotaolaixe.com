@extends('auth.app')
@section('title')
    Xác nhật mật khẩu
@endsection

@section('content')
    <div class="section-authentication-login align-items-center justify-content-center">
        <div class="row">
            <div class="col-12 col-lg-4 col-md-8 mx-auto">
                <div class="card">
                    <div class="row no-gutters">
                        <div class="col-lg-12">
                            <div class="card-body p-md-5">
                                <div class="text-center">
                                    <img src="{{ asset('/') }}backend/assets/images/logo.png" width="150"
                                        alt="">
                                </div>
                                <hr>
                                <h5 class="text-center">{{ __('Xác nhận mật khẩu') }}</h5>
                                <hr>
                                {{ __('Please confirm your password before continuing.') }}

                                <form method="POST" action="{{ route('password.confirm') }}">
                                    @csrf

                                    <div class="form-group row">
                                        <label for="password"
                                            class="col-md-12 col-form-label">{{ __('Mật khẩu') }}</label>

                                        <div class="col-md-12">
                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror" name="password"
                                                required autocomplete="current-password">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-md-8 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Xác nhận mật khẩu') }}
                                            </button>

                                            @if (Route::has('password.request'))
                                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                                    {{ __('Quên mật khẩu của bạn?') }}
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--end row-->
                </div>
            </div>
        </div>
    </div>
@endsection
