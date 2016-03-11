<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use App\Event;
use App\Category;
use App\Tag;
// use App\User;
use Illuminate\Http\Request;
use Validator;
use Response;
//use Request; //use Request replace Illuminate\Http\Request
use App\Http\Requests\EventRequest;

class EventsController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth', ['only' => ['create', 'store']]);
    //$this->middleware('auth', ['except' => ['index', 'show']]);
  }

  /**
  * Display a list of the event.
  *
  *@return Response
  */
  public function index()
  {
    $events = Event::published()->paginate(5);
    return view('events.index', compact('events'));
  }

  /**
  * Show the form for creating a new resource.
  *
  *@return Response
  */
  public function create()
  {
      $tag_list = Tag::lists('name', 'id');
      $category_list = Category::lists('name', 'id');
      return view('events.create', compact('tag_list', 'category_list'));
  }

  public function post_upload(Request $request)
  {
    //$input = $request->all();
    //dd($input);

      $input = $request->all();
      $rules = array(
         'file' => 'image|max:3000',
      );

      $validation = Validator::make($input, $rules);
      //$validation = $this->validate($input, $rules);

      //dd($validation);
      if ($validation->fails())
      {
       return Response::make($validation->errors->first(), 400);
      }

      //$file = $request->file('file');

      if($request->hasFile('file')){
       $image_filename = $request->file('file')->getClientOriginalName();
       $image_name = date('Ymd-His-').$image_filename;
       $public_path = 'images/events/';
       $destination = base_path() . '/public/' . $public_path;
       $upload_success = $request->file('file')->move($destination, $image_name); //move file to destination
       if( $upload_success ) {
        	return Response::json('success', 200);
        } else {
        	return Response::json('error', 400);
        }
      }
  }
}
