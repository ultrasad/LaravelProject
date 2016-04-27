<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Iverberk\Larasearch\Traits\MappableTrait;

class Branch extends Model
{
    //use MappableTrait;

    protected $table = 'branch';

    //Mass Assignment
    protected $fillable = ['name', 'image', 'lat', 'lon', 'zoom', 'detail']; //Whitelist

    public function events()
    {
      return $this->belongsToMany('App\Event');
    }

    public function brands()
    {
      return $this->belongsToMany('App\Brand');
    }
}
