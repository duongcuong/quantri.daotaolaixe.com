@extends('auth.app')
@section('title')
    Quên mật khẩu
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
                                <h5 class="text-center">{{ __('Đặt lại mật khẩu') }}</h5>
                                <hr>
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                <form method="POST" action="{{ route('password.email') }}">
                                    @csrf

                                    <div class="form-group row">
                                        <label for="email"
                                            class="col-md-12 col-form-label">{{ __('E-Mail Address') }}</label>

                                        <div class="col-md-12">
                                            <input id="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                value="{{ old('email') }}" autocomplete="email" autofocus>

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary btn-block">
                                                {{ __('Gửi liên kết thay đổi mật khẩu') }}
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
