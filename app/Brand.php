<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Iverberk\Larasearch\Traits\SearchableTrait;

class Brand extends Model
{
  use SearchableTrait;

  protected $table = 'brand';

  //Mass Assignment
  protected $fillable = ['name', 'url_slug', 'logo_image', 'cover_image', 'slogan', 'detail', 'facebook', 'twitter', 'line_officail', 'youtube', 'approve_status']; //Whitelist

  public static $__es_config = [
      'autocomplete' => ['name'],
      'text_start' => ['name', 'detail'],
  ];

  /**
  * @return bool
  */
  public function shouldIndex()
  {
      // Your custom logic to determine if a (re)index should be performed
      //$this->shouldIndex();
      //$this->deleted('Event');
      return true;
  }

  public function scopeApproved($query)
  {
    $query->where('approve_status', '=', 'Y');
  }

  public function events()
  {
    return $this->hasMany('App\Event');
  }

  public function branch()
  {
    return $this->belongsToMany('App\Branch', 'brand_branch')
                ->withTimestamps(); //update created app, updated app relationship table
  }

  public function category()
  {
    return $this->belongsToMany('App\Category', 'brand_category', 'brand_id', 'cate_id')
                ->withTimestamps(); //update created app, updated app relationship table
  }

  //category, edit list
  public function getCategoryListAttribute()
  {
      //return $this->tags->lists('id');
      return $this->category->lists('name', 'id')->all(); //relationship category events
      //or ican do this
      //return $this->category->lists('id')->toArray();
  }

  public function getCategoryFirstAttribute()
  {
      return $this->category->first();
  }

  //branch list
  public function getBranchListAttribute()
  {
      //return $this->tags->lists('id');
      return $this->branch->lists('name','id')->all(); //relationship branch brand
      //or ican do this
      //return $this->tags->lists('id')->toArray();
  }

  public function user()
  {
      return $this->belongsTo('App\User');
  }

  /*
  public function branch($id=1)
  {
    $branch_list = DB::table('Brand')
                ->leftJoin('brand_branch', 'brand.id', '=', 'brand_branch.brand_id')
                ->where('brand.id', '=', $id)
                ->select('name', 'id')->get();
    return $branch_list;
  }
  */

}
