<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Like;
use App\Models\User;
use App\Models\Tag;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'title',
        'content'
    ];

    public function likes(): HasMany {
        return $this->hasMany(Like::class);
    }

    public function comments(): HasMany {
        return $this->hasMany(Comment::class)->orderBy('created_at', 'asc');;
    }

    public function categories(): HasMany {
        return $this->hasMany(Category::class)->orderBy('created_at', 'asc');;
    }
    public function tags(): HasMany {
        return $this->hasMany(Tag::class)->orderBy('created_at', 'asc');;
    }
    public function user(): BelongsTo {
        return $this->belongsTo(User::class)->orderBy('created_at', 'asc');
    
    }
}