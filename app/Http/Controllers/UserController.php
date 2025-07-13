<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\User;
use inertia\inertia;
use Illuminate\Http\Request;
// use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('cards.ratings')
            ->latest()
            ->paginate(3)
            ->through(function ($user) {
                // جمع كل التقييمات الخاصة بالقصص التي كتبها هذا المستخدم
                $ratings = $user->cards->flatMap(function ($card) {
                    return $card->ratings;
                });

                // حساب متوسط التقييم
                $averageRating = round($ratings->avg('rating') ?? 0, 1);

                // إضافة الخاصية
                $user->average_rating = $averageRating;

                return $user;
            });

        return inertia('Writers', [
            'users' => $users,
        ]);
    }

    public function favoritescard()
    {
        $user = auth()->user();
        $cards = $user->favoriteCards()->with('user')->latest()->paginate(3);
        $cards->getCollection()->transform(function ($card) {
            $card->is_favorite = true; // لأن هذه الصفحة خاصة بالمفضلة
            return $card;
        });
        return inertia::render('User/FavoriteCards', [
            'cards' => $cards
        ]);
    }
    public function toggle(Request $request)
    {
        $request->validate([
            'card_id' => 'required|exists:cards,id',
        ]);

        $user = auth()->user();
        $cardId = $request->card_id;

        if ($user->favoriteCards()->where('card_id', $cardId)->exists()) {
            // إذا كانت موجودة مسبقاً، قم بإزالتها
            $user->favoriteCards()->detach($cardId);
        } else {
            // إذا لم تكن موجودة، أضفها
            $user->favoriteCards()->attach($cardId);
        }

        return back();
    }
    public function writerknow($id)
    {
        $writer = User::with('phone')->findOrFail($id);
        return Inertia::render('Writerknow', [
            'writer' => $writer,
        ]);
    }
    public function UserDashboard(){
             $user = auth()->user();
          $user_stories=$user->cards;
        // ->latest()->paginate(5)
        // ->withQueryString();
        return inertia::render('User/UserDashboard',[
            'user'=>$user,
            'cards'=>$user_stories,
            'status'=>session('status')

        ]);
    }
}
