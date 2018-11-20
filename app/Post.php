<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class Post extends Model
{ 
    use Sluggable;
    use SluggableScopeHelpers;

    protected $fillable = ['user_id', 'category_id', 'image_id', 'title', 'content','slug'];

    public function user(){
        return $this->belongsTo('App\User');
    }
    public function image(){
        return $this->belongsTo('App\Image');
    }
    public function categories(){
        return $this->belongsToMany('App\Category');
    }

    public function comments(){
        return $this->hasMany('App\Comment');
    }
    
    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
