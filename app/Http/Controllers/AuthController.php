<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function view_login()
    {
        return view('login');
    }

    public function login(Request $req)
    {
        $users = User::where('name', $req->name)->get();
        if (count($users) > 0) {
            $user = $users->first();
            if (Hash::check($req->password, $user->password)) {
                if ($user->banned <= 1) {
                    Auth::login($user, $req->get('remember'));
                    return redirect()->route('profile');
                } else {
                    return redirect()->back()->withErrors(['name' => 'You have been banned for: "' . $user->reason . '"']);
                }
            }
        }
        return redirect()->back()->withErrors(['name' => 'wrong username or password']);
    }

    public function logout(Request $req)
    {
        Auth::logout();
        $req->session()->invalidate();
        $req->session()->regenerateToken();
        return redirect()->route('dashboard', ['msg' => 'logged out successfully!']);
    }

    public function view_signup()
    {
        return view('signup');
    }

    public function signup(Request $req)
    {
        $req->name = strtolower($req->name);
        $req->validate([
            'name' => 'required|min:3|max:32|unique:users|regex:/^[a-zA-Z0-9_-]+$/u',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:128|same:confirm_password',
            'confirm_password' => 'required',
            'privacy_policy' => 'required',
        ], [
            'name.required' => 'please choose a username',
            'name.min' => 'username must be at least 3 characters long',
            'name.max' => 'username can\'t surpass 32 characters',
            'name.unique' => 'username is already taken',
            'name.regex' => 'please only use A-Z, 0-9, \'-\' and \'_\'',

            'email.required' => 'please provide your email',
            'email.unique' => 'email is already taken',
            'email.email' => 'please provide us witha real email',

            'password.required' => 'please choose a password',
            'password.min' => 'password must be at least 6 characters long',
            'password.max' => 'password can\'t surpass 128 characters',
            'password.same' => 'passwords do not match',

            'confirm_password.required' => 'please confirm your password',

            'privacy_policy.required' => 'please accept our privacy policy',
        ]);

        $user = new User();
        $user->name = strtolower($req->name);
        $user->email = strtolower($req->email);
        $user->password = Hash::make($req->password);
        $user->remember_token = Hash::make($req->email . $req->name . $req->password);
        $user->save();

        return redirect()->route('view_confirm_email');
    }

    public function view_confirm_email()
    {
        return view('confirm_email');
    }

    public function confirm_email($id, $token)
    {
        $users = User::where([
            ['id', $id],
            ['email_verified_at', '=', null]
        ])->get();
        if (count($users) > 0) {
            $user = $users->first();
            $basic = 7;
            $token_confirm = substr($user->remember_token, $basic + 7, 3) . substr($user->remember_token, $basic + 12, 6) . substr($user->remember_token, $basic + 19, 9);
            if ($token === $token_confirm) {
                $user->email_verified_at = Carbon::now()->toDateTimeString();
                $user->save();
                Auth::login($user);
                return redirect()->route('profile', ['msg' => 'your profile has been created!']);
            }
        }

        return abort(404);
    }

    public function view_forgot_password()
    {
        return view('forgot_password');
    }

    public function forgot_password(Request $req)
    {
    }

    public function view_email_sent()
    {
        return view('email_sent');
    }

    public function view_reset_password()
    {
        return view('reset_password');
    }

    public function reset_password(Request $req)
    {
    }
}
