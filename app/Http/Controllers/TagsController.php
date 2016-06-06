<?php

namespace App\Http\Controllers;

//use Redirect;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Event;
//use App\Tag;

class TagsController extends Controller
{
  public function index($tag='')
  {
      $events = Event::select('events.*', 'events.url_slug as url_slug')->published()->active()->tagList($tag)->orderBy('events.created_at', 'desc')->paginate(10);
      if($events->count() < 1){
        //return Redirect::back()->with('message','Tag Not Exists !');
        return redirect('/');
      } else {
        $tag_name = $events->first()->tags->where('tag', $tag)->first()->name;
      }

      //echo 'name => '. $tag_name;
      //exit;
      return view('tags.list', compact('events', 'tag_name'));
  }
}
