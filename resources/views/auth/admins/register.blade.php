@extends('auth.app')
@section('title')
    Đăng ký
@endsection

@section('content')
    <div class="section-authentication-register align-items-center justify-content-center">
        <div class="row">
            <div class="col-12 col-lg-4 col-md-8 mx-auto">
                <div class="card">
                    <div class="row no-gutters">
                        <div class="col-lg-12">
                            <div class="card-body p-md-5">
                                <div class="text-center">
                                    <img src="{{ asset('/') }}backend/assets/images/logo-icon.png" width="80"
                                        alt="">
                                    <h3 class="mt-4 font-weight-bold">Tạo một tài khoản</h3>
                                </div>
                                <form method="POST" action="{{ route('register') }}" method="post">
                                    @csrf
                                    <div class="form-group  mt-4">
                                        <label>Họ tên</label>
                                        <input type="text" name="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            value="{{ old('name') }}" placeholder="Họ tên" required autocomplete="name"
                                            autofocus />
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Địa chỉ Email</label>
                                        <input type="text" class="form-control  @error('email') is-invalid @enderror"
                                            name="email" value="{{ old('email') }}" required autocomplete="email"
                                            placeholder="example@user.com" />
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Mật khẩu</label>
                                        <div class="input-group" id="show_hide_password">
                                            <input
                                                class="form-control border-right-0 @error('password') is-invalid @enderror"
                                                name="password" required autocomplete="new-password" placeholder="Password"
                                                type="password">
                                            <div class="input-group-append"> <a href="javascript:;"
                                                    class="input-group-text bg-transparent border-left-0"><i
                                                        class='bx bx-hide'></i></a>
                                            </div>
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Nhập lại mật khẩu</label>
                                        <input type="password" class="form-control" placeholder="Nhập lại mật khẩu"
                                            name="password_confirmation" required>
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                                            <label class="custom-control-label" for="customCheck1">Tôi đã đọc và đồng ý với Điều khoản & Điều kiện</label>
                                        </div>
                                    </div>
                                    <div class="btn-group mt-3 w-100">
                                        <button type="submit" class="btn btn-primary btn-block">Đăng ký</button>
                                        <button type="submit" class="btn btn-primary"><i class="lni lni-arrow-right"></i>
                                        </button>
                                    </div>
                                </form>
                                <hr />
                                <div class="text-center mt-4">
                                    <p class="mb-0">Đã có tài khoản? <a href="{{ route('login') }}">Đăng nhập</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end row-->
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $("#show_hide_password a").on('click', function(event) {
                event.preventDefault();
                if ($('#show_hide_password input').attr("type") == "text") {
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass("bx-hide");
                    $('#show_hide_password i').removeClass("bx-show");
                } else if ($('#show_hide_password input').attr("type") == "password") {
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass("bx-hide");
                    $('#show_hide_password i').addClass("bx-show");
                }
            });
        });
    </script>
@endpush
