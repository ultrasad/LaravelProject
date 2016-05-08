<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Event;

class CategoryController extends Controller
{
  public function index($category='')
  {
      $events = Event::published()->active()->categoryList($category)->orderBy('events.created_at', 'desc')->paginate(15);
      if($events->count() < 1){
        //return Redirect::back()->with('message','Tag Not Exists !');
        return redirect('/');
      } else {
        if($category == 'unknow'){
          $category_name = 'unknow';
        } else {
          $category_name = $events->first()->category->where('category', $category)->first()->name;
        }
      }

      //echo 'name => '. $tag_name;
      //exit;
      return view('category.list', compact('events', 'category_name'));
  }
}
