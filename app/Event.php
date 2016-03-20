<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Event extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    //protected $table = 'events';
    //Mass Assignment
    protected $fillable = ['title', 'url_slug', 'start_date', 'end_date', 'image', 'brief', 'description', 'active_now', 'published_at']; //Whitelist
    //protected $guarded = ['id'];// //Backlist

    protected $dates = ['start_date', 'end_date', 'published_at']; //register datetime to carbon object

    //Scope
    public function scopePublished($query)
    {
      $query->where('published_at', '<=', Carbon::now());
    }

    public function scopeUnpublished($query)
    {
      $query->where('published_at', '>', Carbon::now());
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function tags()
    {
      return $this->belongsToMany('App\Tag')
                  ->withTimestamps(); //update created app, updated app relationship table
    }

    public function category()
    {
      return $this->belongsToMany('App\Category')
                  ->withTimestamps(); //update created app, updated app relationship table
    }

    public function branch()
    {
      return $this->belongsToMany('App\Branch')
                  ->withTimestamps(); //update created app, updated app relationship table
    }
}
