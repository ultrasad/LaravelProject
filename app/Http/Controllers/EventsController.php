<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use App\Brand;
use App\Event;
use App\Category;
use App\Tag;
use App\Branch;
use App\Gallery;
use App\Location;
// use App\User;
use Illuminate\Http\Request;
//use Validator;
//use Response;
//use Request; //use Request replace Illuminate\Http\Request
use App\Http\Requests\EventRequest;
//use Input;

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

    echo ini_get('upload_max_filesize').'<br/>';
    echo ini_get('post_max_size').'<br/>';
    //post_max_size
    //ini_set("upload_max_filesize","1000M");
    //ini_set("post_max_size","1000M");
    //echo ini_get("upload_max_filesize").'<br />';
    //echo ini_get("post_max_size").'<br />';

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
      //$tag_list = Tag::lists('name', 'id');
      //$category_list = Category::lists('name', 'id');
      //return view('events.create', compact('tag_list', 'category_list'));

      /*
      $branch_list = Brand::select('name', 'id')
      ->leftJoin('brand_branch', 'brand.id', '=', 'brand_branch.brand_id')
      ->where('brand.id', '=', 1)->get();
      */

      $brand = Brand::find(2); //brand 1

      //foreach($brand->branch as $branch){
        //echo $branch->name . '<br />';
      //}

      //echo '<pre>';
      //print_r($brand->branch);
      //exit;

      return view('events.create', compact('brand'));
  }

  /**
  * Store a newly created resource in storage.
  *
  *@return Response
  */
  public function store(EventRequest $request)
  {
    //echo '<pre>';
    //print_r($_FILES);

    echo '<pre>';
    print_r($request->all());
    exit;

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

    $event_id = Auth::user()->events()->save($event)->id; //user id

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
      //echo 'location >> ' . $location_name . '<br />';
      $location = array();
      $location[] = Location::firstOrCreate(array('name' => $location_name, 'lat' => $location_lat, 'lon' => $location_lon, 'zoom' => $location_zoom))->id;
      $event->location()->sync($location);
    }

    echo '-- exit --';
    exit;
  }

  public function desc_upload(Request $request)
  {
      //if ($request->hasFile('file_upload')) {
        //echo 'file upload <br />';
      //}

      if($request->hasFile('file_upload')){
        $image_filename = $request->file('file_upload')
                         ->getClientOriginalName();
        $image_name = date('Ymd-His-').$image_filename;
        $public_path = 'images/events/'. date('Y-m-d') .'/description/';
        $destination = base_path() . '/public/' . $public_path;
        $upload_success = $request->file('file_upload')->move($destination, $image_name); //move file to destination
        if( $upload_success ) {
        	//return Response::json('success', 200);
          return '/'. $public_path . $image_name;
        } else {
          return false;
        	//return Response::json('error', 400);
        }
      }

      return Response::json('success', 200);

      //echo '<pre>';
      //print_r($request);
      //exit;
  }

  public function post_upload(Request $request)
  {
    //$input = $request->all();
    //dd($input);

    //print_r($request->all());
    //exit;

      $input_files = $request->file();
      //print_r($input_files['file']);
      //exit;

      /*
      $rules = array(
         'file' => 'image|max:3000',
      );

      $validation = Validator::make($input_files, $rules);
      //$validation = $this->validate($input, $rules);

      //dd($validation);
      if ($validation->fails())
      {
       return Response::make($validation->errors->first(), 400);
     }
     */

      $file_index = 0;
      $error = 0;
      $success = 0;
      foreach($input_files['file'] as $file):

        //echo 'key => ' . $key . '<br />';
        //print_r($file);
        //exit;

        //$file = $request->file('file');
        //$file = $file[''.$file_index.''];

        //if($request->hasFile('file')){
         $image_filename = $file->getClientOriginalName();
         $image_name = date('Ymd-His-').$image_filename;
         $public_path = 'images/events/';
         $destination = base_path() . '/public/' . $public_path;
         $upload_success = $file->move($destination, $image_name); //move file to destination
         if( $upload_success ) {
          	//return Response::json('success', 200);
            $success++;
          } else {
          	//return Response::json('error', 400);
            $error++;
          }
        //}
        $file_index++;
      endforeach;

      //return image list array name and path
      if( $error > 0 ) {
        return Response::json('error', 400);
      } else {
        return Response::json('success', 200);
      }

      /*
      $input = $request->all();
      print_r($input);
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
      */
  }
}
