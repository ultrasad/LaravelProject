<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    //Mass Assignment
    protected $fillable = ['name']; //Whitelist

    public function events()
    {
      return $this->belongsToMany('App\Event');
    }
}
