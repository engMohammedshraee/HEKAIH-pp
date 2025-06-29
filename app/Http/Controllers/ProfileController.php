<?php

namespace App\Http\Controllers;

use App\Models\User;
use inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;


class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $phone = $user->phone;
        $cards = $user->cards()->latest()->paginate(6);
        return inertia::render('Profile/HomePage',props: [
            'user' => $user,
            'phone' => $phone,
            'cards'=>$cards,
            'status' => session('status')
        ]);
    }
    public function edit(Request $request)
    {
        $user = $request->user();
        $phone = $user->phone;
        return inertia::render('Profile/Edit', props: [
            'user' => $user,
            'phone' => $phone,
            'status' => session(['status','success'])
        ]);
    }
    public function updateinfo(Request $request)
    {
        $user = auth()->user();

        $userinfo = $request->validate([
            'defenation' => ['required'],
            'email' => [
                'required',
                'email',
                'max:55',
                Rule::unique(User::class)->ignore($user->id),
            ],
        ]);
        $user->fill($userinfo);

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $user->save();

        $userphone = $request->validate([
            'call_phone' => ['required', 'max:15'],
            'social_phone' => [
                'required',
                'max:15'

            ],
        ]);
        if ($user->phone) {
            $user->phone()->update([
                'call_phone' => $userphone['call_phone'],
                'social_phone' => $userphone['social_phone'],
            ]);
        } else {
            $user->phone()->create([
                'call_phone' => $userphone['call_phone'],
                'social_phone' => $userphone['social_phone'],
            ]);
        }

        return redirect()->route('profile.edit')->with('status', 'info updatesuccessfly');
    }
    public function updateimage(Request $request)
    {
        $user = auth()->user();

        $fildes = $request->validate([
            'image' => ['nullable', 'file', 'mimes:jpg,png,jpeg,webp'],

        ]);
        if ($request->hasFile('image')) {
            if ($user->image) {
                //this to check if image wasw update delete last image
                Storage::disk('public')->delete($user->image);
            }
            $fildes['image'] = Storage::disk('public')->put('images/cards', $request->image);
        } else {
            $fildes['image'] = $request->image;
        }


        //this filter to tages delet dash and any repeare
        $request->user()->fill($fildes);
        $request->user()->save();


        return redirect()->route('profile.edit')->with('status', ' user update profile succesfly');
    }
    public function updateprofile(Request $request)
    {
        $user = auth()->user();
        $fildes = $request->validate([
            'profile' => ['nullable', 'file', 'mimes:jpg,png,jpeg,webp'],

        ]);
        if ($request->hasFile('profile')) {
            if ($user->profile) {
                //this to check if image wasw update delete last image
                Storage::disk('public')->delete($user->profile);
            }
            $fildes['profile'] = Storage::disk('public')->put('images/cards', $request->profile);
        } else {
            $fildes['profile'] = $request->profile;
        }

        //this filter to tages delet dash and any repeare
        $request->user()->fill($fildes);
        $request->user()->save();


        return redirect()->route('profile.edit')->with('status', ' user update profile succesfly');
    }
}
