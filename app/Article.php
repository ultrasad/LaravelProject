<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Article extends Model
{
    //Mass Assignment
    protected $fillable = ['title', 'body', 'published_at']; //Whitelist
    //protected $guarded = ['id'];// //Backlist

    protected $dates = ['published_at']; //register datetime to carbon object

    //Mutators, convert date to subday
    public function setPublishedAtAtribute($ddate)
    {
      $this->attributes['published_at'] = Carbon::parse($date)->subDay();
    }

    //relationship, User Model
    /*public function user()
    {
      return $this->belongTo('App\User');
    }*/

    //Scope
    public function scopePublished($query)
    {
      $query->where('published_at', '<=', Carbon::now());
    }

    public function scopeUnpublished($query)
    {
      $query->where('published_at', '>', Carbon::now());
    }
}
