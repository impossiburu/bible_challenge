<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $fields = Validator::make($request->only(['phone', 'password']), [
            'phone' => 'required',
            'password' => 'required',
        ]);

        if ($fields->fails()) {
            return back()->withErrors($fields);
        }

        if (!Auth::attempt(['phone' => $request->phone, 'password' => $request->password])) {
            return back()->withErrors('Такой пользователь не зарегистрирован');
        }

        $request->session()->regenerate();
        Artisan::call('cache:clear');
        return redirect()->intended('/account');
    }

    public function register(Request $request)
    {
        $fields = Validator::make($request->only(['phone', 'password', 'email']), [
            'phone' => 'required|numeric|unique:users|min:11',
            'password' => 'required|min:8',
            'email' => 'required|email|unique:users',
        ]);

        if ($fields->fails()) {
            return back()->withErrors($fields);
        }

        User::create([
            'name' => 'user' . $request->phone,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'email' => $request->email,
            'level' => 1,
            'ghost_health' => 1,
        ]);

        return redirect('/');
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();

        return redirect('/');
    }
}
