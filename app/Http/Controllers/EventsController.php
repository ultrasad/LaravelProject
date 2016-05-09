<?php

namespace App\Http\Controllers;

//use Storage;
//use Illuminate\Http\Request;
use Redirect;
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

//use Request;
use Request as Response;
//use Illuminate\Http\Request;

class EventsController extends Controller
{
  public function __construct()
  {
    //ini_set('always_populate_raw_post_data', -1);

    //$this->middleware('auth', ['only' => ['create', 'store']]);
    $this->middleware('auth', ['except' => ['index', 'search', 'show', 'desc_upload', 'locations', 'branch']]);
  }

  function string_friendly($string)
  {
    $string = preg_replace("`\[.*\]`U","",$string);
    $string = preg_replace('`&(amp;)?#?[a-z0-9]+;`i','-',$string);
    $string = str_replace('%', '-percent', $string);
    $string = htmlentities($string, ENT_COMPAT, 'utf-8');
    $string = preg_replace("`&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);`i","\\1", $string);
    $string = strtolower(preg_replace(array("`[^a-z0-9ก-๙เ-า]`i","`[-]+`"), "-", $string));
    return $string;
    //echo strtolower(trim($string, '-')).'.html';
  }

  /**
  * Search Test
  */
  public function search($keywords='watsons')
  {
    //$results = Event::search($keywords, ['fields' => ['title', 'url_slug', 'brief', 'brand.name', 'location.name'], 'select' => ['title', 'brief', 'image', 'brand.name', 'location.name'], 'highlight' => true, 'suggest' => true]);
    //$results = Event::search($keywords, ['fields' => ['title', 'brief', 'brand.name', 'location.name'], 'select' => ['title', 'brief', 'brand.name', 'location.name'], 'highlight' => ['tag' => '<span style="color:red">'], 'suggest' => true]);
    $results = Event::search($keywords, ['fields' => ['title', 'url_slug', 'brief', 'brand.name', 'location.name'], 'highlight' => ['tag' => ' ']]);
    //$highlights = $results->getResults()->first()->getHighlights(['location.name']);
    //$suggestios = $results->getSuggestions();

    $arr_response = array();
    $arr_location = array();
    if($results){
      foreach($results->getResults() as $result){
        $arr_data = array('title' => $result->title, 'image' => $result->image, 'url_slug' => $result->url_slug, 'brief' => $result->brief, 'brand' => $result->brand['name']);
        array_push($arr_response, $arr_data);

        $locations = $result->getHighlights(['location.name']);
        if(!empty($locations)){
          foreach($locations as $key => $location){
            $arr_map = array('id' => $result->location[0]['id'], 'name' => $location[0], 'lat' => $result->location[0]['lat'], 'lon' => $result->location[0]['lon']);
            array_push($arr_location, $arr_map);
          }
        }
      }
    }
    echo json_encode(array('event' => $arr_response, 'map' => $arr_location));
  }

  /**
  * Display a list of the event.
  *
  *@return Response
  */
  public function index()
  {
    //$events = Event::published()->active()->eventBrand()->orderBy('events.created_at', 'desc')->paginate(15); //old remove event brand
    $events = Event::published()->active()->orderBy('events.created_at', 'desc')->paginate(20);
    //$events = Event::published()->active()->orderBy('events.created_at', 'desc')->paginate(15);

    //echo '<pre>';
    //print_r($events);
    //exit;

    //$tag = 'โปรโมชั่น watsons ภาษาไทย';
    //$tag = $this->string_friendly($tag);
    //echo $tag;
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
      $category = Category::select('name', 'id')->where('category_type', 'event')->get();
      $brand = Brand::select('id', 'name')->get();
      //$branch = $brand->first()->branch_list; //default null
      $branch = array();

      //echo '<pre>';
      //print_r($category);
      //exit;

      return view('events.create', compact('brand', 'branch', 'category'));
  }

  /**
  * Store a newly created resource in storage.
  *
  *@return Response
  */
  public function store(EventRequest $request)
  {
    $event = new Event($request->all());

    //echo '<pre>';
    //print_r($request->input('branch'));

    //echo '<pre>';
    //print_r($event);
    //exit;

    //image
    if($request->hasFile('image')){
      $image_filename = $request->file('image')->getClientOriginalName();
      $file_name = pathinfo($image_filename, PATHINFO_FILENAME); // name
      $extension = pathinfo($image_filename, PATHINFO_EXTENSION); // extension
      $image_name = date('Ymd-His-').str_slug($file_name) . '.' . $extension;
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

    //category
    $categoryId = $request->input('category');
    if(!empty($categoryId)){
       $event->category()->sync($categoryId);
    }

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
         //$tag = str_slug($name); //helper url
         $tag = $this->string_friendly($name);
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
         $file_name = pathinfo($image_filename, PATHINFO_FILENAME); // name
         $extension = pathinfo($image_filename, PATHINFO_EXTENSION); // extension
         $image_name = date('Ymd-His-').str_slug($file_name) . '.' . $extension;
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
    $location_name = $request->input('event_location');
    $location_lat = $request->input('location_lat');
    $location_lon = $request->input('location_lon');
    $location_zoom = $request->input('location_zoom');

    if($location_name != '' && $location_lat != '' && $location_lon != ''){
      $location = array();
      $location[] = Location::firstOrCreate(array('name' => $location_name, 'lat' => $location_lat, 'lon' => $location_lon, 'zoom' => $location_zoom))->id;
      $event->location()->sync($location);
      echo '<pre>';
      print_r($location);
    } else {
      echo 'null location >>';
    }

    //re(index) larasearch
    //$event->reIndex();
    $event->reIndex('App\Event --relations');

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
      //$event = Event::where('url_slug', $slug)->eventBrand()->first();
      $event = Event::where('url_slug', $slug)->first();
      if($event->count() < 1)
        //return Redirect::back()->with('message','Event Not Exists !');
        return redirect('/');

      $branchs = array();
      $tags = array();
      //$locations = array();

      //echo '<pre>';
      //print_r($event->branch);
      //exit;

      foreach($event->branch->all() as $index => $branch){
        //$branchs[]= link_to('brand/'.$event->brand_id . '/' . $branch, $branch, array('alt' => $branch));
        //$branchs[]= link_to('#' . $branch, $branch, array('alt' => $branch));
        $branchs[] = '<span><i class="pg-map hint-text-9" aria-hidden="true"></i> </span>' . link_to('#' . $branch->name, $branch->name, array('alt' => $branch->name, 'data-index' => $index, 'class' => 'place'));
        //$locations[] = array('name' => $branch->name, 'lat' => $branch->lat, 'lon' => $branch->lon);
      }

      foreach($event->tags->all() as $index => $tag){
        //$tags[] = '<i class="fa fa-check-circle hint-text m-t-10"></i> ' . link_to('/tag/' . $tag->tag, $tag->name, array('title' => $tag->name, 'data-index' => $index, 'class' => 'tag'));
        $tags[] = '<span><i class="fa fa-tag fa-flip-horizontal hint-text-8 m-t-10" aria-hidden="true"></i> </span>' . link_to('/tags/' . $tag->tag, $tag->name, array('title' => $tag->name, 'data-index' => $index, 'class' => 'tag'));
      }

      //if(!empty($locations)){
        //$locations = json_encode($locations);
      //}

      //echo '<pre>';
      //print_r($branchs_location);
      //foreach($event->brand->all() as $brand){
        //echo ($brand->name) . '<br />';
      //}
      //echo $branchs_location;
      //exit;

      //echo '<pre>';
      //print_r($branchs);
      //echo implode(', ', $branchs);
      //exit;

      //echo $event->category_first->name;
      //exit;

      //echo '<pre>';
      //print_r($event->category_first->name);
      //exit;

      //echo '<pre>';
      //print_r($event->tags->all());
      //exit;

      $event_id = $event->id;
      $event_title = $event->title;
      $cate_id = isset($event->category->first()->id)?$event->category->first()->id:'';
      $relates = array();
      if($event_id && $cate_id !=''){
        $relates = Event::published()->active()->eventBrand()->relateThis($event_id, $cate_id)->orderBy('events.created_at', 'desc')->skip(0)->take(6)->get();
      }

      //echo 'cate id => ' . $cate_id;
      //echo '<pre>';
      //print_r($relates);
      //exit;

      //echo 'event id => ' . $event_id;
      //echo '<br />event cate id => ' . $cate_id;

      //$relate = Event::published()->active()->eventBrand()->RelateThis($slug)->orderBy('events.created_at', 'desc')->limit(6);
      //**$relates = Event::published()->active()->eventBrand()->relateThis($event_id, $cate_id)->orderBy('events.created_at', 'desc')->skip(0)->take(1)->get();
      //echo '<pre>';
      //print_r($relate[0]->category[0]->name);
      //exit;

      //echo 'brand => '. $event->brand->category_first->name;
      //exit;

      return view('events.show', compact('event', 'branchs', 'locations', 'tags', 'relates', 'event_title'));
  }

  /**
  * Show the form for editing the specified resource.
  *
  *@param int $id
  *@return Response
  */
  public function edit($id)
  {
    $event = Event::find($id);
    //$tag_list = Tag::lists('name', 'id');
    if(!$event)
      return Redirect::back()->with('message','Event Not Exists !');

    $category = Category::select('name', 'id')->where('category_type', 'event')->get();
    $brand = Brand::select('id', 'name')->get();
    //$branch = array();
    //if(isset($event->brand_id)){
      $brand_active = Brand::find($event->brand_id);
      $branch = $brand_active->branch_list; //default null
    //}
    //$branch = array();

    /*if(in_array(1, $event->category_list)){
      echo 'in array >>';
    }*/

    //echo '<pre>';
    //print_r($brand);
    //exit;

    //echo $event->branch_list;
    $obj = array();
    $result = array();
    //if(isset($event->gallery_list)){
      foreach($event->gallery_list as $file){
        $fileinfo = base_path() .'/public/'. $file;
        $filename = pathinfo($fileinfo)['basename'];
        $filesize = filesize($fileinfo);

        //echo '<pre>';
        //print_r(pathinfo($fileinfo));
        //exit;

        $obj['name'] = $filename; //get the filename in array
        $obj['size'] = $filesize; //get the flesize in array
        $obj['fileinfo'] = '/'.$file; //get the fileinfo in array
        $result[] = $obj; // copy it to another array
      }
    //}
    $gallery =  json_encode($result);

    //echo '<pre>';
    //print_r($result);
    //exit;

    //$gallery = Response::json('success', $result);
    //$gallery =  json_encode($result);

    //$location = array();
    //if(isset($event->location_first)){
      $location = $event->location_first;
    //}

    //echo 'gallery => ' . $gallery;
    //exit;

    //echo '<pre>';
    //print_r($location);
    //exit;
    //$string_tag = '';
    //if(isset($event->tag_list)){
      $string_tag = implode(',', $event->tag_list);
    //}
    //echo $string_tag;
    //exit;

    if(empty($event))
      abort(404);
    return  view('events.edit', compact('event', 'category', 'brand', 'branch', 'string_tag', 'gallery', 'location'));
  }

  /**
  * Update the specified resource in storage.
  *
  *@param int $id
  *@return Response
  */
  public function update($id, EventRequest $request)
  {
    //$event = Event::findOrFail($id);
    //$event = new Event($request->all());
    //$event->title = $request->input('title');
    $event = Event::find($id);
    $input = $request->all(); /* Request all inputs */
    $event_id = $request->input('event_edit_id');

    //image
    if($request->hasFile('image')){
      $base_hash = md5_file(base_path() . '/public/' . $event->image);
      $image_hash = md5_file($request->file('image')->getPathName());

      //echo 'old image => ' . base_path() . '/public/' . $event->image;
      //echo '<br />path => ' . $request->file('image')->getPathName();
      //echo '<br />base hash => ' . $base_hash;
      //echo '<br />img hash => ' . $image_hash;
      //exit;

      if($base_hash != $image_hash){
        $image_filename = $request->file('image')->getClientOriginalName();
        $file_name = pathinfo($image_filename, PATHINFO_FILENAME); // name
        $extension = pathinfo($image_filename, PATHINFO_EXTENSION); // extension
        $image_name = date('Ymd-His-').str_slug($file_name) . '.' . $extension;
        $public_path = 'images/events/' . date('Y-m-d') . '/';
        $destination = base_path() . '/public/' . $public_path;
        $request->file('image')->move($destination, $image_name); //move file to destination
        $input['image'] = $public_path . $image_name; //set article image name
      } else {
        $input['image'] = $event->image;
      }
    }

    //url slug
    $url_slug = str_slug($request->input('url_slug'));
    $base_slug = $url_slug;

    $i=1; $dup=1;
    do {
      //$slug = Event::firstOrNew(array('url_slug' => $base_slug));
      $slug = Event::where('url_slug', '=', $base_slug)->where('id', '!=', $event_id)->first();
      if($slug){
        $base_slug = $url_slug . '-' . $i++;
      } else {
        $dup=0;
      }
    } while($dup==1);
    $input['url_slug'] = $base_slug;

    //category
    $categoryId = $request->input('category');
    if(!empty($categoryId)){
       $event->category()->sync($categoryId);
    }

    //brand
    $input['brand_id'] = $request->input('brand');

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
         //$tag = str_slug($name); //helper url
         $tag = $this->string_friendly($name);
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
         $file_name = pathinfo($image_filename, PATHINFO_FILENAME); // name
         $extension = pathinfo($image_filename, PATHINFO_EXTENSION); // extension
         $image_name = date('Ymd-His-').str_slug($file_name) . '.' . $extension;
         $public_path = 'images/events/'. date('Y-m-d') .'/gallery/'. $event_id . '/';
         $destination = base_path() . '/public/' . $public_path;
         $upload_success = $file->move($destination, $image_name); //move file to destination
         if( $upload_success ) {
            $success++;
            $image = $destination;
            $images[] = Gallery::firstOrCreate(array('name' => $image_name, 'image' => $public_path . $image_name))->id;
          } else {
            $error++;
          }
          $file_index++;
      }
      $event->gallery()->sync($images);
    }

    //location
    $location_name = $request->input('event_location');
    $location_lat = $request->input('location_lat');
    $location_lon = $request->input('location_lon');
    $location_zoom = $request->input('location_zoom');

    if($location_name != '' && $location_lat != '' && $location_lon != ''){
      $location = array();
      $location[] = Location::firstOrCreate(array('name' => $location_name, 'lat' => $location_lat, 'lon' => $location_lon, 'zoom' => $location_zoom))->id;
      $event->location()->sync($location);
    }

    $event->fill($input);
    $event->save();

    //$event->update($request->all());

    //echo '<pre>';
    //print_r($request->all());
    //exit;

    /*
    if($request->hasFile('image')){
      $image_filename = $request->file('image')
                       ->getClientOriginalName();
      $image_name = date('Ymd-His-').$image_filename;
      $public_path = 'images/articles/';
      $destination = base_path() . '/public/' . $public_path;
      $request->file('image')->move($destination, $image_name); //move file to destination
      $article->image = $public_path . $image_name; //set article image name
      $article->save(); //update
    }

    $tagsId = $request->input('tag_list');
    if(!empty($tagsId))
      $article->tags()->sync($tagsId);
    else
      $article->tags()->detach();
    return redirect('articles');
    */
  }

  //admin event lists
  public function admin()
  {
    $events = Event::published()->active()->eventBrand()->orderBy('events.created_at', 'desc')->get();
    return view('events.admin', compact('events'));
  }

  public function locations($event)
  {
    $event = Event::findOrFail($event);
    echo json_encode($event->branch->all());
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
        $image_filename = Request::file('file_upload')->getClientOriginalName();
        $file_name = pathinfo($image_filename, PATHINFO_FILENAME); // name
        $extension = pathinfo($image_filename, PATHINFO_EXTENSION); // extension
        $image_name = date('Ymd-His-').str_slug($file_name) . '.' . $extension;
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

  /**
  * Display the speified resource.
  *
  *@param int $id
  *@return Response
  */
  public function _branch(Request $request)
  {
    $id = $request->input('id');
    $brand = Brand::find($id);
    echo json_encode($brand->branch_list);
  }

  public function branch($id)
  {
    $brand = Brand::findOrFail($id);
    echo json_encode($brand->branch_list);
  }

}
