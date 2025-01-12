@extends('auth.app')
@section('title')
    Đăng nhập
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
                                <form action="{{ route('admins.login') }}" method="post">
                                    @csrf
                                    <div class="form-group mt-4">
                                        <label>Địa chỉ Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            value="{{ old('email') }}" name="email"
                                            placeholder="Enter your email address" />

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>
                                    <div class="form-group">
                                        <label>Mật khẩu</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                            name="password" placeholder="Enter your password" />
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" id="remember" name="remember"
                                                    class="custom-control-input" {{ old('remember') ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="remember">Nhớ đăng nhập</label>
                                            </div>
                                        </div>
                                        @if (Route::has('password.request'))
                                            <div class="form-group col text-right"> <a
                                                    href="{{ route('password.request') }}"><i
                                                        class='bx bxs-key mr-2'></i>Quyên mật khẩu?</a>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="btn-group mt-3 w-100">
                                        <button type="submit" class="btn btn-primary btn-block">Đăng nhập</button>
                                        <button type="submit" class="btn btn-primary"><i class="lni lni-arrow-right"></i>
                                        </button>
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
