<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    protected $table = 'social';

    protected $fillable = ['social', 'social_id', 'name', 'token', 'long_live_token', 'page_token']; //Whitelist

    public function brand()
    {
        return $this->belongsToMany('App\Brand');
    }

    public function scopePageExists($query, $brand_id, $page_id)
    {
      //echo 'id => '. $brand_id;
      //echo '<pre>';
      //print_r($page_id);

      return $this->whereHas('brand', function($query) use ($brand_id){
        $query->where('id', '=', $brand_id);
      })->select('social_id')->whereIn('social.social_id', $page_id);
    }
}