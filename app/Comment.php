<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'post_id',
        'is_active',
        'author',
        'email',
        'body'
    ];

    public function replies(){
        $this->hasMany('App\CommentReply');
    }
}
