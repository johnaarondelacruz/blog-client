<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Post;
use App\Models\User;

class Tag extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'post_id',
        'tag_name'
    ];

    public function post(): BelongsTo {
        return $this->belongsTo(Post::class);
    }
    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
