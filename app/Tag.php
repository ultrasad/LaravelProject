<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //Mass Assignment
    protected $fillable = ['name', 'tag']; //Whitelist

    public function articles()
    {
      return $this->belongsToMany('App\Article');
    }

    public function events()
    {
      return $this->belongsToMany('App\Event');
    }
}
