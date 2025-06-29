<?php

namespace App\Http\Controllers\Auth;

use inertia\inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    public function create()
    {
        return inertia::render('Auth/Login',[
                        'status' => session('status')

        ]);
    }
    public function store(Request $request)
    {
        $credential = $request->validate([
            'email' => "required|email",
            'password' => "required"
        ]);

        if (Auth::attempt($credential, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->route('home');
        }
        return back()->withErrors([
            'email' => 'the creaintial email dose not match with our record',
        ])->onlyInput('email');
    }
    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }
}
