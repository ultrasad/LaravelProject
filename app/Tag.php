<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Iverberk\Larasearch\Traits\SearchableTrait;

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
