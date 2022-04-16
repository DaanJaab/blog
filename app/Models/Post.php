<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = [
        'slug',
        'title',
        'text',
        'category_id'
    ];
    //protected $with = ['comments', 'user', 'category'];


    public function user()
    {
        return $this->belongsTo(User::class)->select('id', 'name', 'name_slug', 'role');
    }

    public function authorInfo()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function userAllInfo()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function latestComment()
    {
        return $this->hasOne(Comment::class, 'post_id', 'id')->latest();
    }

    public function category()
    {
        return $this->belongsTo(PostsCategory::class, 'category_id', 'id')->select('id', 'name', 'name_slug', 'description');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
