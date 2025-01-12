@extends('auth.app')
@section('title')
    Thay đổi mật khẩu
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
                                <h5 class="text-center">{{ __('Cài đặt mật khẩu') }}</h5>
                                <hr>
                                <form method="POST" action="{{ route('password.update') }}">
                                    @csrf

                                    <input type="hidden" name="token" value="{{ $token }}">

                                    <div class="form-group row">
                                        <label for="email" class="col-md-12 col-form-label">{{ __('Địa chỉ Email') }}</label>

                                        <div class="col-md-12">
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="password" class="col-md-12 col-form-label">{{ __('Mật khẩu') }}</label>

                                        <div class="col-md-12">
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="password-confirm" class="col-md-12 col-form-label">{{ __('Nhập lại mật khẩu') }}</label>

                                        <div class="col-md-12">
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-md-12 offset-md-12">
                                            <button type="submit" class="btn btn-primary btn-block">
                                                {{ __('Đặt lại mật khẩu') }}
                                            </button>
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
