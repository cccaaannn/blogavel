<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth/register');
    }

    public function onRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'min:3', 'max:50', Rule::unique('users', 'name')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:3', 'max:50'],
            'password_confirmation' => ['required', 'same:password']
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $formData = $validator->validated();
        $formData['password'] = bcrypt($formData['password']);

        $user = User::create($formData);

        auth()->login($user);

        return redirect('/');
    }

    public function login()
    {
        return view('auth/login');
    }

    public function onLogin(Request $request)
    {
        $formData = $request->validate([
            'name' => 'required',
            'password' => 'required'
        ]);

        if (auth()->attempt([
            'name' => $formData['name'],
            'password' => $formData['password']
        ])) {
            $request->session()->regenerate();
            return redirect('/');
        }

        return back()->withErrors([
            'name' => __('generic.incorrect_credentials'),
        ]);
    }

    public function onLogout()
    {
        auth()->logout();
        return redirect('/');
    }
}
