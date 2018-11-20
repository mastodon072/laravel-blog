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
        return  $this->hasMany('App\CommentReply');
    }
    public function post(){
        return $this->belongsTo('App\Post');
    }

    
    public function getGravatar($email){
        $hash = md5(strtolower(trim($email)));
        return 'http://www.gravatar.com/avatar/'.$hash.'?d=mm';
    }
}
