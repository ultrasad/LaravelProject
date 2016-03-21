<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
  protected $table = 'locations';
  //Mass Assignment
  protected $fillable = ['name', 'lat', 'lon', 'zoom']; //Whitelist
  public function events()
  {
    return $this->belongsToMany('App\Event');
  }
}
