<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NetaMemo extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'idea_word_id',
        'content',
        'posted_by',
        'remarks',
        // データベースに書き込むことが許可されたカラム名

    ];
}
