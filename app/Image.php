<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['file'];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
