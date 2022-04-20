<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PostsCategory extends Model
{
    use HasFactory;

    protected $table = 'posts_categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'name_slug',
        'description'
    ];

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'category_id', 'id');
    }
    public function latestPost()
    {
        return $this->hasOne(Post::class, 'category_id', 'id')->latest();
    }

    public function comments()
    {
        return $this->hasManyThrough(Comment::class, Post::class, 'category_id', 'post_id', 'id', 'id');
    }

    public function getRouteKeyName()
    {
        return 'name_slug';
    }
}
