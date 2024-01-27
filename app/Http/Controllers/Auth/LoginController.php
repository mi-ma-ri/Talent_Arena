<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function login(LoginRequest $request)
    {
        $userType = $request->input('user_type'); //login.bladeからPostされる
        $credentials = $request->only('email', 'password');

        $guard = $userType === 'teams' ? 'teams' : 'web';

         Log::debug('ログイン試行', ['userType' => $userType, 'guard' => $guard]);

        if (Auth::guard($guard)->attempt($credentials)) {
            $request->session()->regenerate();
            $redirectView = $userType === 'teams' ? 'team/info' : 'player/info';
            return redirect()->intended($redirectView);
        }

        // Log::debug('ログイン失敗', ['email' => $credentials['email']]);

        return back();
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        
        return redirect('/completion-logout');
    }

    public function completion_logout()
    {
        return view('completion_logout');
    }
    


    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
