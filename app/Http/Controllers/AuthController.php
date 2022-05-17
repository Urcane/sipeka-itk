<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index(Request $request)
    {
        // return view('auth.login');
        return redirect('dashboard');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }

        try {
            $credentials = request(['email', 'password']);

            if (!Auth::attempt($credentials)) {
                return back()->withErrors('Ups, email atau password kamu salah nih.');
            }

            $user = User::where('email', $request->email)->first();

            if (!Hash::check($request->password, $user->password)) {
                return back()->withErrors('Password kamu salah.');
            }

            return redirect(route('dashboard'));
        } catch (\Throwable $th) {
            Log::info($th);
        }
        
    }
    
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            return redirect(route('dashboard'));
        } catch (\Throwable $th) {
            Log::info($th);
        }
    }

    public function logout(Request $request)
    {        
        Auth::logout();

        return redirect('/login');
    }
}
