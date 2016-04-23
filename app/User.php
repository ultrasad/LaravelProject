<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
   * Get the articles that hasmany to the user.
   */
    public function articles()
    {
        return $this->hasMany('App\Article');
    }

    public function events()
    {
      return $this->hasMany('App\Event');
    }

    public function roles()
    {
      return $this->belongsToMany('App\Role')
                  ->withTimestamps(); //update created app, updated app relationship table
    }
}
