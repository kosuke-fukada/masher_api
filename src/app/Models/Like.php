<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'user_id',
        'tweet_id',
        'author_id',
        'like_count'
    ];
}
