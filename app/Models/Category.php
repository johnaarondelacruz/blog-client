<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Post;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'post_id',
        'category_name',
    ];

    public function post(): BelongsTo {
        return $this->belongsTo(Post::class);
    }
}
