<?php

namespace App\Models;

use App\Models\Card;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['user_id', 'card_id', 'content','commentdepartment'];
    public function user()
{
    return $this->belongsTo(User::class);
}

public function story()
{
    return $this->belongsTo(Card::class);
}
}

