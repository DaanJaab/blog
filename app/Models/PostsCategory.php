<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PostsCategory extends Model
{
    use HasFactory, Sluggable;

    protected $table = 'posts_categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
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
        return 'slug';
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
