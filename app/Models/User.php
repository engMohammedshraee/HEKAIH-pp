<?php

namespace App\Models;

use App\Models\Card;
use App\Models\Comment;
use App\Models\PhoneNumber;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'defenation',
        'role',
        'rate',
        'image',
        'profile',
        'type'

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function cards()
    {
        return $this->hasMany(Card::class);
    }
      public function phone()
    {
        return $this->hasOne(PhoneNumber::class);
    }
    public function comments()
{
    return $this->hasMany(Comment::class);
}


    public function favoriteCards()
{
    return $this->belongsToMany(Card::class, 'favorite_cards_user');
}
    public function scopeFilter($query, array $filters)
    {
        if ($filters['search'] ?? false) {
            $query->where(
                function ($q) {
                    $q->where('name', 'like', '%' . request('search') . '%')
                        ->orWhere('email', 'like', '%' . request('search') . '%');

                }
            );
        }
        if ($filters['user_role'] ?? false) {
            $query->where('role', request('user_role'));
        }

    }
}
