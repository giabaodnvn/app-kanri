<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * @var rememberToken;
     */
    private $rememberToken = true;

    /**
     * Login Page
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function showLoginForm()
    {
        if (Auth::user()) {
            return redirect()->guest(route('admin.admin-dashboard'));
        }
        return view('admin.login');
    }

    /**
     * Handle Login
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postFormLogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password], $this->rememberToken)) {
            return redirect()->route('admin.admin-dashboard');
        }
        return redirect()->back()->with('error', 'Wrong username or password')->withInput($request->only('username', 'remember'));
    }

    /**
     * Logout
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('admin.admin-login');
    }
}
