<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory, SoftDeletes;
    //use Prunable;

    protected $fillable = [
        'content'
    ];

    //protected $with = ['user'];

    public function user()
    {
        return $this->belongsTo(User::class)->select('id', 'name', 'slug', 'role');
    }

    public function authorInfo()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function userAllInfo()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function category()
    {
        return $this->belongsTo(PostsCategory::class)->select('id', 'name', 'slug', 'description');
    }


    /*public function prunable()
    {
        return static::where('created_at', '<=', now()->subMonth());
    }*/
}
