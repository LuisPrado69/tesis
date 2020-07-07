<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\System\User;

/**
 * Class LoginController
 * @package App\Http\Controllers\Auth
 */
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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        $user = $this->checkUserStatus($request);

        if ($user != null) {
            if ($user->enabled == 0) {
                return redirect()->back()
                    ->withInput($request->only($this->username()))
                    ->withErrors([
                        $this->username() => trans('auth.user_inactive'),
                    ]);
            } else {
                if (!$this->checkUserRolesStatus($user)) {
                return redirect()->back()
                    ->withInput($request->only($this->username()))
                    ->withErrors([
                        $this->username() => trans('auth.user_has_no_roles'),
                    ]);
                }
            }
        } else {
            return $this->sendFailedLoginResponse($request);
        }
        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        $changedPassword = $this->checkUserChangedPassword($request);

        session(['changedPassword' => $changedPassword]);

        return $this->authenticated($request, $this->guard()->user()) ?: redirect()->intended($this->redirectPath());
    }

    public function credentials(Request $request)
    {

        return array_merge($request->only($this->username(), 'password'), ['enabled' => 1]);

    }

    public function checkUserStatus(Request $request)
    {
        return User::where('username', $request->only($this->username()))->first();
    }

    public function checkUserVerify(Request $request)
    {
        return User::where('username', $request->only($this->username()))->first();
    }

    public function checkUserChangedPassword(Request $request)
    {
        $user = User::where('username', $request->only($this->username()))->first();
        return $user->changed_password == 1;
    }

    public function checkUserRolesStatus($user)
    {
        foreach ($user->roles as $role){
            if ($role->enabled == 1) {
                return true;
            }
        }
        return false;
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'username';
    }

    public function showLoginForm()
    {
        $settingsRepository = resolve('App\Repositories\Repository\Configuration\SettingRepository');

        $logos = $settingsRepository->findByKey('ui_logos');
        $labels = $settingsRepository->findByKey('ui_project_labels');

        return view('auth.login', [
            'logos' => $logos->value,
            'labels' => $labels->value
        ]);
    }

}
