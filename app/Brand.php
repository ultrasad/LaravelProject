<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
  protected $table = 'brand';

  //Mass Assignment
  protected $fillable = ['name', 'logo_image', 'logo_cover', 'slogan', 'detail', 'category', 'facebook', 'twitter', 'line_officail', 'youtube', 'approve_status']; //Whitelist

  public function events()
  {
    return $this->hasMany('App\Event');
  }

  public function branch()
  {
    return $this->belongsToMany('App\Branch', 'brand_branch')
                ->withTimestamps(); //update created app, updated app relationship table
  }

  //branch list
  public function getBranchListAttribute()
  {
      //return $this->tags->lists('id');
      return $this->branch->lists('name','id')->all(); //relationship branch brand
      //or ican do this
      //return $this->tags->lists('id')->toArray();
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
