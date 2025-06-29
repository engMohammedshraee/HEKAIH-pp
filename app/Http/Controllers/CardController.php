<?php

namespace App\Http\Controllers;

use App\Models\Card;
use inertia\Inertia;
use App\Models\CardRating;
use Illuminate\Http\Request;
use function Termwind\render;

use App\Http\Controllers\auth;
use Illuminate\Support\Facades\Storage;

class CardController extends Controller
{
    /**
     * Display a card of the resource.
     */



    public function index()
    {
        $user = auth()->user();

        $filters = [
            'search' => request('query'),
            'level' => request('level'),
        ];

        $cards = Card::with(['user', 'userFavorites'])
            ->filter($filters)
            ->latest()
            ->paginate(6)
            ->through(function ($card) use ($user) {
                $card->is_favorite = $user ? $card->userFavorites->contains($user->id) : false;
                return $card;
            });

        return inertia('Home', [
            'cards' => $cards,
            'status' => session('status'),
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia::render('Cards/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $fildes = $request->validate([
            'titel' => 'required',
            'desc' => 'required',
            'image' => ['nullable', 'file', 'mimes:jpg,png,jpeg,webp'],
            'sound' => ['nullable', 'file', 'mimes:mp3'],
            'category' => ['nullable', 'string'],
            'level' => ['nullable', 'string'],
        ]);
        if ($request->hasFile('image')) {
            $fildes['image'] = Storage::disk('public')->put('images/cards', $request->image);
        }
        if ($request->hasFile('sound')) {
            $fildes['sound'] = Storage::disk('public')->put('sound/card', $request->sound);
        }
        $request->user()->cards()->create($fildes);
        return redirect()->route('home')->with('status', 'create card successfly');
    }

    /**
     * Display the specified resource.
     */public function show(Card $Card)
{
    $user = auth()->user();

    // تحميل التعليقات مع المستخدمين
    $cardcomment = Card::with(['comments.user'])->findOrFail($Card->id);

    // تحميل العلاقات الأخرى
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


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $card = Card::find($id);
        return inertia::render('Cards/Edit', [
            'Card' => $card
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $card = Card::findOrFail($id);
        $fildes = $request->validate([

            'titel' => 'required|string',
            'desc' => 'required|string',
            'image' => 'nullable|file|mimes:jpg,png,jpeg,webp', // 5MB
            'sound' => 'nullable|file|mimes:mp3,wav', // 10MB
            'category' => 'string',
            'level' => 'string',

        ]);
        if ($request->hasFile('image')) {
            if ($card->image) {
                //this to check if image wasw update delete last image
                Storage::disk('public')->delete($card->image);
            }
            $fildes['image'] = Storage::disk('public')->put('images/cards', $request->image);
        } else {
            $fildes['image'] = $card->image;
        }
        if ($request->hasFile('sound')) {
            if ($card->sound) {
                // إذا كان هناك ملف صوتي سابق → يتم حذفه
                Storage::disk('public')->delete($card->sound);
            }
            $fildes['sound'] = Storage::disk('public')->put('sound/card', $request->sound);
        } else {
            // إذا لم يتم رفع صوت جديد → احتفظ بالصوت القديم
            $fildes['sound'] = $card->sound;
        }

        $card->update($fildes);

        return redirect()->route('home')->with('status', ' card update successfly');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $card = Card::findOrFail($id);

        if ($card->image) {
            Storage::disk('public')->delete($card->image);
        }
        if ($card->sound) {
            Storage::disk('public')->delete($card->sound);
        }
        $card->delete();
        return redirect()->route('home')->with('status', ' card deleted successfly');
    }
    public function see_stories()
    {

        $user = auth()->user();
        $cards = Card::with(['user', 'userFavorites']) // نحمّل العلاقات
            ->latest()
            ->paginate(6)
            ->through(function ($card) use ($user) {
                // نضيف خاصية is_favorite لكل كرت حسب المستخدم الحالي
                $card->is_favorite = $user
                    ? $card->userFavorites->contains($user->id)
                    : false;
                return $card;
            });


        return inertia::render('Stories', [
            'cards' => $cards,
        ]);
    }

    // صفحة عرض قصة مع التعليقات والتقييم
    public function listen($id)
    {
        $user = auth()->user();

        $card = Card::with(['comments.user', 'ratings'])->findOrFail($id);

        $userRating = 0;
        if ($user) {
            $userRating = $card->ratings()
                ->where('user_id', $user->id)
                ->value('rating') ?? 0;
        }

        $averageRating = round($card->ratings()->avg('rating') ?? 0, 1);

        return inertia('Cards/Listen', [
            'card' => $card,
            'user' => $user,
            'cardcomment' => $card,
            'userRating' => $userRating,
            'averageRating' => $averageRating,
        ]);
    }

    // دالة استقبال وحفظ أو تحديث تقييم المستخدم
    public function rate(Request $request, $cardId)
    {
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login');
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);

        CardRating::updateOrCreate(
            [
                'user_id' => $user->id,
                'card_id' => $cardId,
            ],
            [
                'rating' => $request->rating,
            ]
        );

        return redirect()->route('Card.listen', $cardId)
            ->with('success', 'تم حفظ التقييم بنجاح.');
    }

    public function preview(Request $request)
    {
        // التحقق من البيانات (validation)
        $validated = $request->validate([
            'titel' => 'required|string|max:255',
            'desc' => 'required|string',
            'image' => 'nullable|image',
            'sound' => 'nullable|file|mimes:mp3,wav',
        ]);

        // إرسال البيانات إلى صفحة المعاينة بدون حفظ
        return Inertia::render('Cards/Preview', [
            'card' => $validated,
        ]);
    }
}
