<?php

namespace App\Models;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Card extends Model
{
    /** @use HasFactory<\Database\Factories\CardFactory> */
    use HasFactory;
    protected $fillable = [
        'titel',
        'desc',
        'image',
        'sound',
        'category',
        'level',
        'approved'


    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function userFavorites()
    {
        return $this->belongsToMany(User::class, 'favorite_cards_user');
    }
    public function comments()
{
    return $this->hasMany(Comment::class)->with('user');
}
public function ratings()
{
    return $this->hasMany(CardRating::class);
}

public function scopeFilter($query, $filters)
{
    if (!empty($filters['search'])) {
        $query->where('titel', 'like', '%' . $filters['search'] . '%');
    }

    if (!empty($filters['level'])) {
        $query->where('level', $filters['level']);
    }

    return $query;
}


}
