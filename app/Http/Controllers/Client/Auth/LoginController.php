<?php

namespace App\Http\Controllers\Client\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::CLIENT;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:client')->except('logout');
    }

    public function showLoginForm()
    {
        return view('admin.clients.dashboard.auth.login');
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            'login' => [trans('auth.failed')],
        ]);
    }

    protected function loggedOut(Request $request)
    {
        toast(trans('site.you_are_loggedOut') ,'success');
                return $request->wantsJson()
                ? new JsonResponse([], 204)
                : redirect('dashboard/client/login/');
    }

    protected function authenticated(Request $request, $user)
    {
        toast(trans('site.welcome_back').' '.$user->user_name,'success');
        return to_route('client.dashboard');
    }

    public function username()
    {
        $login = request()->input('login');
        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'user_name';
        request()->merge([$fieldType => $login]);
        return $fieldType;
    }

    protected function guard()
    {
        return Auth::guard('client');
    }
}
