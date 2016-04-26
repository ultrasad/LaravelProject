<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //Mass Assignment
    protected $fillable = ['name', 'category', 'category_type']; //Whitelist

    public function articles()
    {
      return $this->belongsToMany('App\Article');
    }

    public function events()
    {
      return $this->belongsToMany('App\Event');
    }
}
