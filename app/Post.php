<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{ 
    protected $fillable = ['user_id', 'category_id', 'image_id', 'title', 'content'];

    public function user(){
        return $this->belongsTo('App\User');
    }
    public function image(){
        return $this->belongsTo('App\Image');
    }
    public function category(){
        return $this->belongsTo('App\Category');
    }
}
