<?php

namespace App\Http\Controllers\Auth;

use inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;


class RegisterController extends Controller
{
  public function create(){
    return inertia::render('Auth/Register');
  }
  public function store(Request $request){
    $storeuser=$request->validate([
        'name'=>'required|max:10',
        'email'=>'required|email',
        'password'=>'required|confirmed'

    ]);
    $user = User::create($storeuser);
    //send verification email
       event(new Registered($user));

    Auth::login($user);
    return redirect()->route('home');

  }
}
