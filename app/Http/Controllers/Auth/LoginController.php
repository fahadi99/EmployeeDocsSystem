<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\PersonRight;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\Person;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Session;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'required',
            'password' => 'required',
        ], [
            $this->username() . '.exists' => 'The selected email is invalid or the account has been disabled.',
            'password.required' => 'Please provide valid credentials.',
        ]);
    }

    public function login(Request $request)
    {
        // $this->validateLogin($request);
        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.

        //dd($request->all());


        if (method_exists($this, 'hasTooManyLoginAttempts') &&
        $this->hasTooManyLoginAttempts($request)) {
        $this->fireLockoutEvent($request);
        return $this->sendLockoutResponse($request);
        }

        $username = $request->username;
        if (is_numeric($username)) {
            $this->validate($request,[
                'username'=>['required', 'string','min:11','max:14', 'regex:/\+(9[976]\d|8[987530]\d|6[987]\d|5[90]\d|42\d|3[875]\d|
                2[98654321]\d|9[8543210]|8[6421]|6[6543210]|5[87654321]|
                4[987654310]|3[9643210]|3[70]|7|1)\d{1,14}$/'],
                'password'=>'required'
             ],
             [
                'username.regex' => 'Please Enter the phone number in proper format.',
                'password.required' => 'Please provide valid credentials.',

             ]);

            // Check if user is active
            $user = Person::where('phone', $request->username)->first();

            if ($user && $user->is_guest) {
                return \Redirect::back()->withErrors(['Wrong Credentials']);
            }

            if ($this->LoginWithPhone($request)) {
                $res = $this->sendLoginResponse($request);
                $memberId = Auth::user()->id;
                Session::put('rights', PersonRight::getRightString($memberId));
                return $res;
            }


        } else {
            $this->validate($request, [
                $this->username() => 'exists:persons,' . $this->username() . ',active,1',
                'password' => 'required',
            ], [
                $this->username() . '.exists' => 'The selected email is invalid or the account has been disabled.'
            ]);

            // Check if user is active
            $user = Person::where('email', $request->username)->first();

            if ($user && $user->is_guest) {
                return \Redirect::back()->withErrors(['Wrong Credentials']);
            }

            if ($this->LoginWithEmail($request)) {
                $res = $this->sendLoginResponse($request);
                $memberId = Auth::user()->id;
                Session::put('rights', PersonRight::getRightString($memberId));
                return $res;
            }

        }


       // dd('done');





       /* if ($this->attemptLogin($request)) {
            $res = $this->sendLoginResponse($request);
            $memberId = Auth::user()->id;
            Session::put('rights', PersonRight::getRightString($memberId));
            return $res;
        } */

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    public function LoginWithEmail ($request) {
        if (Auth::attempt(['email' => $request->username,'password' => $request->password], false)){
           return true;
        }
    }

    public function LoginWithPhone ($request) {
        if (Auth::attempt(['phone' => $request->username,'password' => $request->password], false)){
           return true;
        }
    }


    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/login');
    }
}
