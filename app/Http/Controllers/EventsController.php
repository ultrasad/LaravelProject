<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\EventRequest;

use Auth;
use App\Brand;
use App\Event;
use App\Category;
use App\Tag;
use App\Branch;
use App\Gallery;
use App\Location;

use Request;
//use Illuminate\Http\Request;

class EventsController extends Controller
{
  public function __construct()
  {
    //$this->middleware('auth', ['only' => ['create', 'store']]);
    $this->middleware('auth', ['except' => ['index', 'show', 'desc_upload']]);
  }

  /**
  * Display a list of the event.
  *
  *@return Response
  */
  public function index()
  {
    $events = Event::published()->active()->brandEvent()->orderBy('events.created_at', 'desc')->paginate(15);

    //echo '<pre>';
    //print_r($events);
    //exit;

    return view('events.list', compact('events'));
  }

  /**
  * Show the form for creating a new resource.
  *
  *@return Response
  */
  public function create()
  {
      $brand = Brand::select('id', 'name')->get();
      $branch = $brand->first()->branch_list;

      //echo '<pre>';
      //print_r($brand);
      //exit;

      return view('events.create', compact('brand', 'branch'));
  }

  /**
  * Store a newly created resource in storage.
  *
  *@return Response
  */
  public function store(EventRequest $request)
  {
    $event = new Event($request->all());

    //image
    if($request->hasFile('image')){
      $image_filename = $request->file('image')
                       ->getClientOriginalName();
      $image_name = date('Ymd-His-').$image_filename;
      $public_path = 'images/events/' . date('Y-m-d') . '/';
      $destination = base_path() . '/public/' . $public_path;
      $request->file('image')->move($destination, $image_name); //move file to destination
      $event->image = $public_path . $image_name; //set article image name
    }

    //published
    if($request->input('published_now')){
      $event->published_at = $request->input('published_now');
    }

    //url slug
    $url_slug = str_slug($request->input('url_slug'));
    $base_slug = $url_slug;

    $i=1; $dup=1;
    do {
      $slug = Event::firstOrNew(array('url_slug' => $base_slug));
      if($slug->exists){
        $base_slug = $url_slug . '-' . $i++;
      } else {
        $dup=0;
      }
    } while($dup==1);
    $event->url_slug = $base_slug;

    //brand
    $event->brand_id = $request->input('brand'); //event brand

    $event_id = Auth::user()->events()->save($event)->id; //user id

    //branch
    $branchId = $request->input('branch');
    if(!empty($branchId)){
       $event->branch()->sync($branchId);
    }

    //tags
    $tagsId = $request->input('tag_list');
    if(!empty($tagsId)){
       $tag_list = explode(',', $tagsId);
       //$tags = Event::InsertTag($tagsId);
       $tags = array();
       foreach($tag_list as $name)
       {
         //$tag = preg_replace('/[^a-zA-Z0-9]+/', '-', strtolower(trim($name)));
         $tag = str_slug($name); //helper url
         $tags[] = Tag::firstOrCreate(array('name' => $name, 'tag' => $tag))->id;
       }
       $event->tags()->sync($tags);
    }

    //gallery
    $gallery = $request->file('gallery');
    $success = 0;
    $error = 0;
    $file_index = 0;
    if($gallery){
      $images = array();
      foreach($gallery as $file){
         $image_filename = $file->getClientOriginalName();
         $image_name = date('Ymd-His-').$image_filename;
         $public_path = 'images/events/'. date('Y-m-d') .'/gallery/'. $event_id . '/';
         $destination = base_path() . '/public/' . $public_path;
         $upload_success = $file->move($destination, $image_name); //move file to destination
         if( $upload_success ) {
            $success++;
            $image = $destination;
            //$images[] = Gallery::firstOrCreate(array('name' => $name, 'tag' => $tag))->id;
            $images[] = Gallery::firstOrCreate(array('name' => $image_name, 'image' => $public_path . $image_name))->id;
          } else {
            $error++;
            //echo $upload_success . '<br />';
          }
          $file_index++;
      }
      $event->gallery()->sync($images);
    }

    //location
    $location_name = $request->input('location_name');
    $location_lat = $request->input('location_lat');
    $location_lon = $request->input('location_lon');
    $location_zoom = $request->input('location_zoom');

    if($location_name != '' && $location_lat != '' && $location_lon != ''){
      $location = array();
      $location[] = Location::firstOrCreate(array('name' => $location_name, 'lat' => $location_lat, 'lon' => $location_lon, 'zoom' => $location_zoom))->id;
      $event->location()->sync($location);
    }

    echo '-- exit --';
    exit;
  }

  /**
  * Display the speified resource.
  *
  *@param int $id
  *@return Response
  */
  public function show($slug)
  {
      if(is_numeric($slug)) {
          $event = Event::findOrFail($slug);
          return redirect()->action('EventsController@show', ['slug' => $event->url_slug]);
      }

      //$event = Event::with('user', 'category')->where('slug', $slug)->first();
      $event = Event::where('url_slug', $slug)->brandEvent()->first();

      //echo $event->category_first->name;
      //exit;

      //echo '<pre>';
      //print_r($event->category_first->name);
      //exit;
      return view('events.show', compact('event'));
  }
  /*
  public function show($id)
  {
    //echo '=> ' . $id;

    $event = Event::find($id);
    if(empty($event))
      abort(404);

    return view('events.show', compact('event'));
  }
  */

  public function desc_upload()
  {
      if(Request::ajax() && Request::hasFile('file_upload')){
        $image_filename = Request::file('file_upload')
                         ->getClientOriginalName();
        $image_name = date('Ymd-His-').$image_filename;
        $public_path = 'images/events/'. date('Y-m-d') .'/description/';
        $destination = base_path() . '/public/' . $public_path;
        $upload_success = Request::file('file_upload')->move($destination, $image_name); //move file to destination
        if( $upload_success ) {
          return '/'. $public_path . $image_name;
        } else {
          return false;
        }
      }

      return Response::json('success', 200);
  }

}
