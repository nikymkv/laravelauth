<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '.admins.index';
    protected $guard = 'admin';

    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function redirectTo()
    {
        return $this->redirectTo;
    }

    public function guard()
    {
        return Auth::guard($this->guard);
    }

    public function showLoginForm()
    {
        return view('auth.login', [
            'title' => 'Admin Login',
            'loginRoute' => 'admin.login',
            'logoutRoute' => 'admin.logout',
            'forgotPasswordRoute' => 'admin.password.request',
        ]);
    }

    public function login(Request $request)
    {
        $this->validator($request);

        if (Auth::guard('admin')->attempt(
                    $request->only('email', 'password'),
                    $request->filled('remember')
                )) {
            return redirect()
                ->intended(route('admin' . $this->redirectTo))
                ->with('status', 'You are logged in as Admin!');
        }


        return $this->loginFailed();
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()
            ->route('admin.login')
            ->with('status', 'Admin has been logged out!');
    }

    private function validator(Request $request)
    {
        $rules = [
            'email'    => 'required|email|exists:admins|min:5|max:191',
            'password' => 'required|string|min:4|max:255',
        ];

        $messages = [
            'email.exists' => 'These credentials do not match our records.',
        ];

        $request->validate($rules, $messages);
    }

    private function loginFailed()
    {
        return redirect()
            ->back()
            ->withInput()
            ->with('error','Login failed, please try again!');
    }
}
