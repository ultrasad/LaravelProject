<?php

namespace App\Helpers;
use Illuminate\Database\Eloquent\Model;

use App\Category;
use App\Brand;

class MenuHelper {

  public static function brand()
  {
    return Brand::get();
  }

  public static function menu()
  {
    return Category::orderBy('order_id', 'asc')->get();
  }

  /*public static function dateFormat1($date) {
        if ($date) {
            $dt = new DateTime($date);

        return $dt->format("m/d/y"); // 10/27/2014
      }
   }*/
}
