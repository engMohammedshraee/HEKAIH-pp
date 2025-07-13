<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\User;
use inertia\inertia;
use App\Models\Comment;
use App\Models\CardRating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();
        $comments = Comment::all();
        $stories = Card::all();
        $cardsrating = CardRating::all();
        return inertia::render('Admin/AdminDashboard', [
            'users' => $users,
            'comments' => $comments,
            'cardsrating' => $cardsrating,
            'stories' => $stories
        ]);
    }
    public function userController($id)
    {

        $users = User::with('cards')
            ->findOrFail($id);
        // ->filter(request(['search', 'user_role']))
        // ->paginate(5)
        // ->withQueryString();
        return inertia::render('Admin/UsersControll', [
            'user' => $users,
            'status' => session('status')
        ]);
    }
    public function show(Request $request)
    {
        $users = User::all();
        return Inertia::render('Admin/Users', [
            'users' => $users,
        ]);
    }
    public function role(Request $request, User $user)
    {

        $request->validate(['role' => 'required|string']);
        $user->update(['role' => $request->role]);
        return redirect()->route('admin.userController', $user->id)
            ->with('status', "user role chang to {$request->role} sccessfly");
    }
    public function userstories($id)
    {
        $user = User::findOrFail($id);
        $user_stories = $user->cards;
        // ->latest()->paginate(5)
        // ->withQueryString();
        return inertia::render('Admin/Userstories', [
            'user' => $user,
            'cards' => $user_stories,
            'status' => session('status')

        ]);
    }
    public function showstory($id)
    {
        $user = auth()->user();

        // تحميل التعليقات مع المستخدمين
        $cardcomment = Card::with(['comments.user'])->findOrFail($id);

        // تحميل العلاقات الأخرى
        $Card = Card::findOrFail($id);
        $Card->load(['user', 'userFavorites', 'ratings']);

        // تحديد هل المستخدم أضافها للمفضلة
        $Card->is_favorite = $user
            ? $Card->userFavorites->contains($user->id)
            : false;

        // تقييم المستخدم الحالي إن وجد
        $userRating = 0;
        if ($user) {
            $userRating = $Card->ratings()
                ->where('user_id', $user->id)
                ->value('rating') ?? 0;
        }

        // متوسط التقييم العام للقصة
        $averageRating = round($Card->ratings()->avg('rating') ?? 0, 1);

        return inertia('Cards/ReadStory', [
            'card' => $Card,
            'user' => $user,
            'Cardcomment' => $cardcomment,
            'userRating' => $userRating,
            'averageRating' => $averageRating,
        ]);
    }
    public function approved(Card $card)
    {

        $card->update(['approved' => !$card->approved]);
        $mes = $card->approved ? 'مفتوحة' : 'موقفة  ';
        return back()->with('status', "تم تحديث القصة الى {$mes}");
    }
    public function Reports()
    {
        //this to whow reports for every month
        $storiesforeverymonth = Card::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->pluck('count', 'month')
            ->toArray();

        $data = [];
        for ($i = 1; $i <= 12; $i++) {
            $data[] = $storiesforeverymonth[$i] ?? 0;
        }

        //this to return more reaed story
        $stories = Card::with(['user', 'ratings'])
            ->whereHas('ratings', function ($query) {
                $query->where('approved', true);
            })
            ->get();
        return inertia::render('Admin/Reports', [
            'stories' => $stories,
            'data' => $data
        ]);
    }
}
