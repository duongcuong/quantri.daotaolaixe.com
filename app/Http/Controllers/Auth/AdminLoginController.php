<?php
// AdminLoginController.php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.admins.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'login' => 'required|string', // Có thể là email hoặc số điện thoại
            'password' => 'required|string|min:6',
        ]);

        $credentials = [
            filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone' => $request->login,
            'password' => $request->password,
        ];

        if (Auth::guard('admin')->attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('admins.dashboard'));
        }

        return back()->withInput($request->only('email', 'remember'))->withErrors([
            'email' => 'These credentials do not match our records.',
        ]);
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admins.login');
    }
}
