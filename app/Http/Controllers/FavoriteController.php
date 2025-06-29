<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class FavoriteController extends Controller
{
      public function index()
    {

        $cards = User::favoriteCards()->with('user')->get();

        return Inertia::render('Favorites/Index', [
            'Cards' => $cards
        ]);
    }

    // public function toggle( Card $card)
    // {
    //     $user = Auth::user();

    //     $exists = $user->favorites()->where('card_id', $card->id)->exists();

    //     if ($exists) {
    //         $user->favorites()->where('card_id', $card->id)->delete();
    //     } else {
    //         $user->favorites()->create(['card_id' => $card->id]);
    //     }

    //     return back();
    // }
}

