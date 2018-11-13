<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['file'];

    protected $uploads = '/images/';

    public function user(){
        return $this->belongsTo('App\User');
    }
    public function getFileAttribute($path){
        return $this->uploads.$path;
    }
}
