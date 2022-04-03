<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'description'
    ];

    //protected $with = ['user'];

    public function user()
    {
        return $this->belongsTo(User::class)->select('id', 'name', 'role');
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
