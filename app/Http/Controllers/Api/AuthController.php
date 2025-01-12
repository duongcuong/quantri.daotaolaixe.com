<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\TokenRepository;
use Laravel\Passport\Http\Controllers\TransientTokenController;
use Carbon\Carbon;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    //
    public function login(Request $request)
    {

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $tokenResult = $user->createToken('auth_api');
            $token = $tokenResult->token;
            $token->expires_at = Carbon::now()->addMinutes(60);
            $accessToken = $tokenResult->accessToken;
            $expires = $tokenResult->token->expires_at;

            return response()->json([
                'success' => true, 
                'data' =>   [
                    'access_token' => $accessToken,
                    'user' => $user
                ], 
                'msg' => 'Đăng nhập thành công'
            ]);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    public function logout()
    {
        $user = Auth::user();
        $user->token()->revoke();
        return response()->json([
            'success' => true, 
            'data' => [],
            'msg' => 'Đăng xuất thành công'
        ]);
    }

    public function verifyToken(Request $request)
    {
        $tokenId = $request->input('token_id');

        $token = app(TokenRepository::class)->findForId($tokenId);

        if ($token && $token->user_id === $request->user()->id) {
            return response()->json(['message' => 'Token is valid']);
        } else {
            return response()->json(['error' => 'Invalid token'], 401);
        }
    }

    public function refreshAccessToken(Request $request)
    {
        $controller = app(TransientTokenController::class);

        return $controller->refresh($request);
    }

    public function sendOTP(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['message' => 'Email không tồn tại.'], 404);
        }

        $otp = $this->generateOTP();
        $expiresAt = Carbon::now()->addMinutes(\App\Helpers\Constant::OTP_EXPIRES);

        $user->otp = $otp;
        $user->otp_expires_at = $expiresAt;
        $user->save();

        $response = Password::sendResetLink([
            'email' => $request->email,
            'token' => $otp,
            'otp_expires_at' => $expiresAt,
        ]);

        if ($response === Password::RESET_LINK_SENT) {
            return response()->json(['message' => 'Mã OTP đã được gửi đến địa chỉ email của bạn.']);
        } else {
            return response()->json(['message' => 'Không thể gửi mã OTP. Vui lòng thử lại sau.'], 500);
        }
    }

    public function showResetForm($token)
    {
        $user = User::where('otp', $token)->first();

        if (!$user || $user->otp_expires_at < Carbon::now()) {
            return response()->json(['message' => 'Mã OTP không hợp lệ hoặc đã hết hạn.'], 400);
        }

        return view('reset_password', ['token' => $token]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'otp' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);

        $user = User::where([
            ['otp', '=', $request->otp],
            ['email', '=', $request->email]
        ])->first();

        if (!$user || $user->otp_expires_at < Carbon::now()) {
            return response()->json(['message' => 'Mã OTP không hợp lệ hoặc đã hết hạn.'], 400);
        }

        $user->password = bcrypt($request->password);
        $user->otp = null;
        $user->otp_expires_at = null;
        $user->save();

        return response()->json(['message' => 'Đổi mật khẩu thành công.']);
    }

    private function generateOTP()
    {
        return rand(100000, 999999);
    }
}
