<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //Mass Assignment
    protected $fillable = ['name']; //Whitelist

    public function articles()
    {
      return $this->belongsToMany('App\Article');
    }
}
