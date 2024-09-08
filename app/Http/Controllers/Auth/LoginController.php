<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/posts'; // Default redirect path for non-admin users

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Validate the user credentials.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        $credentials = $request->only($this->username(), 'password');

        // Check for hardcoded admin credentials
        if ($credentials[$this->username()] === 'admin@gmail.com' && $credentials['password'] === 'adminpassword') {
            return $credentials; // Allow login for hardcoded admin
        }

        // For other users, validate against the database
        return $credentials;
    }

    /**
     * Handle user authentication and redirection after login.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated($request, $user)
    {
        // Check if the user is the hardcoded admin
        if ($user->email === 'admin@gmail.com') {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('posts.index');
    }

    /**
     * Get the username field.
     *
     * @return string
     */
    public function username()
    {
        return 'email'; 
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::route('posts.index'); 
    }
}
