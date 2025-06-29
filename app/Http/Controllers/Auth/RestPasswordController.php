<?php

namespace App\Http\Controllers\Auth;

use inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use App\Models\User;


class RestPasswordController extends Controller
{
    public function requestpassword(Request $request){
        return inertia::render('Auth/ForgetPassword',[
            'status'=>session('status ')
        ]);

    }
      public function sendEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::ResetLinkSent
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }
        public function resetForm(Request $request)
    {
        return inertia::render(
            'Auth/ResetPasswordForm',
            [
                'email' => $request->email,
                'token' => $request->route('token')
            ]
        );
    }
    public function resethandlerpassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PasswordReset
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);


    }
       public function edit()
    {
        return inertia::render('Auth/ChangePassword');
    }

    public function updateafterlogin(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'new_password' => ['required', 'confirmed', 'min:8'],
        ]);

        $user = $request->user();
        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return redirect()->route('profile.edit')->with('success', 'تم تحديث كلمة المرور بنجاح');
    }
}
