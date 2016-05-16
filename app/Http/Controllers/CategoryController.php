<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Event;
use App\Category;

class CategoryController extends Controller
{
  public function index($category='')
  {
      $category_name = 'ไม่ระบุ หมวดหมู่';
      $cate = Category::where('category', $category)->first();
      if($cate){
        $category_name = $cate->name;
      } else {
        if($category != 'unknow'){
          return redirect('/');
        }
      }

      //try {
      $events = Event::published()->active()->categoryList($category)->orderBy('events.created_at', 'desc')->paginate(15);
      //$category_name = $events->first()->category->where('category', $category)->first()->name;

      /*if($events->count() > 0){
        if($category == 'unknow'){
          $category_name = 'ไม่ระบุ หมวดหมู่';
        } else {
          $category_name = $events->first()->category->where('category', $category)->first()->name;
        }
      }*/

      /*
      if($events->count() < 1){
        //return Redirect::back()->with('message','Tag Not Exists !');
        //return redirect('/');
        $category_name = Category::nameCateId($category);
      } else {
        if($category == 'unknow'){
          $category_name = 'ไม่ระบุ หมวดหมู่';
        } else {
          $category_name = $events->first()->category->where('category', $category)->first()->name;
        }
      }
      */

    //} catch(ErrorException $e) {
      //abort(404);
    //}

      //echo 'name => '. $category_name;
      //exit;
      return view('category.list', compact('events', 'category_name'));
  }
}
