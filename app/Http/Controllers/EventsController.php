<?php

namespace App\Http\Controllers;

use Cache;
use Redirect;
use Illuminate\Http\Request;
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

//use GlideImage;

use Request as Response;

class EventsController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth', ['except' => ['index', 'search', 'show', 'desc_upload', 'locations', 'removefile', 'branch']]);
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
  }

  /**
  * Search Test
  */
  public function search($keywords='watsons')
  {
    $query['query']['match']['_all'] = $keywords;

    $results = Event::searchByQuery($query);
    $highlights = Event::search($keywords, ['fields' => ['location.name'], 'highlight' => ['tag' => ' ']])->getResults();

    $arr_response = array();
    $arr_location = array();
    if($results){
      foreach($results->getResults() as $result){
        $arr_data = array('title' => $result->title, 'image' => $result->image, 'url_slug' => $result->url_slug, 'brief' => $result->brief, 'brand' => $result->brand['name']);
        array_push($arr_response, $arr_data);
      }
    }

    if($highlights){
      foreach($highlights as $key => $highlight){
        $location = $highlight->getHighlights();
        $arr_map = array('id' => $highlight->location[0]['id'], 'name' => $location['location.name.analyzed'][0], 'lat' => $highlight->location[0]['lat'], 'lon' => $highlight->location[0]['lon']);
        array_push($arr_location, $arr_map);
      }
    }

    echo json_encode(array('event' => $arr_response, 'map' => $arr_location));
  }

  /**
  * Display a list of the event.
  *
  *@return Response
  */
  public function index(Request $request)
  {

    /*$outputPath = base_path('public/images/outputfolder/second_image.jpg');
    $glideImage = GlideImage::load('images/stock-photo-120916649.jpg', ['w' => '250' , 'filt' => 'greyscale'])
      ->save($outputPath);

    return view('welcome')
      ->with(compact('glideImage'));

    exit;*/

    $paginate = 10;
    $events = Event::published()->active()->orderBy('events.updated_at', 'desc')->orderBy('events.created_at', 'desc')->paginate($paginate);

    $more_page = $events->hasMorePages();
    $total_page = $events->total();

    return view('events.list', compact('events', 'more_page', 'total_page', 'paginate'));
  }

  /**
  * Show the form for creating a new resource.
  *
  *@return Response
  */
  public function create()
  {
      $user_id = Auth::user()->id;
      $role_id = Auth::user()->role_id;

      if($role_id == 4){ //brand
        $brands = Brand::select('id', 'name')->where('user_id', $user_id)->get();
      } elseif($role_id < 4) { //manager, admin
        $brands = Brand::select('id', 'name')->get();
      }

      if($brands->count() == 1){
        $branch = Branch::brandList($brands->first()->id)->get();
      } else {
        $branch = array();
      }

      $brand_category = $brands->first()->category_list;

      return view('events.create', compact('brands', 'branch', 'brand_category', 'role_id'));
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
       $tags = array();
       foreach($tag_list as $name)
       {
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

    $event->reIndex('App\Event --relations');

    if($event->id > 0){
      return Response::json('success', array(
                  'status' => 'success',
                  'event_id'   => $event->id
              ));
    }
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

      $event = Cache::remember('Promotion_' . $slug, 1440, function() use ($slug) {
        return Event::where('url_slug', $slug)->first();
      });

      if(!$event)
        return redirect('/');

      $branchs = array();
      $tags = array();

      foreach($event->branch->all() as $index => $branch){
        $branchs[] = '<span><i class="pg-map hint-text-9" aria-hidden="true"></i></span>' . link_to('#' . $branch->name, $branch->name, array('title' => $branch->name, 'data-index' => $branch->lat.','.$branch->lon.','.$branch->name, 'class' => 'place'));
      }

      $tags_relate = array();
      foreach($event->tags->all() as $index => $tag){
        array_push($tags_relate, $tag->tag);
        $tags[] = '<span><i class="fa fa-tag fa-flip-horizontal hint-text-8 m-t-10" aria-hidden="true"></i></span> ' . link_to('/tag/' . $tag->tag, $tag->name, array('title' => $tag->name, 'data-index' => $index, 'class' => 'tag'));
      }

      $event_id = $event->id;
      $event_title = $event->title;
      $cate_id = isset($event->category->first()->id)?$event->category->first()->id:'';
      $relates = array();
      if($event_id){
        $relates = Event::published()->active()->relateThis($event_id, $cate_id, $tags_relate)->skip(0)->take(6)->get();
      }

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
    $user_id = Auth::user()->id;
    $role_id = Auth::user()->role_id;

    if($role_id == 4){ //brand
      $brands = Brand::select('id', 'name')->where('user_id', $user_id)->get();
      $arr_brand = array();
      foreach($brands as $brand){
        array_push($arr_brand, $brand->id);
      }

      $event = Event::whereIn('brand_id', $arr_brand)->where('id', $id)->get();
      if($event->count() < 1){
        abort(401);
        exit;
      }

    } elseif($role_id < 4){ // manager, admin
      $brands = Brand::select('id', 'name')->get();
      $event = Event::find($id);
    }

    $branch = array();
    if($brands->count() == 1){
      $branch = Branch::brandList($brands->first()->id)->get();
    }

    $brand_active = Brand::find($event->brand_id);
    $branch = $brand_active->branch_list; //default null

    $obj = array();
    $result = array();
    foreach($event->gallery_list as $file){
      $fileinfo = base_path() .'/public/'. $file;
      $filename = pathinfo($fileinfo)['basename'];
      $filesize = filesize($fileinfo);

      $obj['name'] = $filename; //get the filename in array
      $obj['size'] = $filesize; //get the flesize in array
      $obj['fileinfo'] = '/'.$file; //get the fileinfo in array
      $result[] = $obj; // copy it to another array
    }
    $gallery =  json_encode($result);

    $location = $event->location_first;

    $string_tag = implode(',', $event->tag_list);
    $brand_category = $brands->first()->category_list;

    if(empty($event))
      abort(404);

    return  view('events.edit', compact('event', 'brand_category', 'brands', 'branch', 'string_tag', 'gallery', 'location', 'role_id'));
  }

  /**
  * Update the specified resource in storage.
  *
  *@param int $id
  *@return Response
  */
  public function update($id, EventRequest $request)
  {
    $event = Event::find($id);
    $input = $request->all(); /* Request all inputs */
    $event_id = $request->input('event_edit_id');

    //image
    if($request->hasFile('image')){
      $base_hash = '';
      if(is_file(base_path() . '/public/' . $event->image)){
          $base_hash = md5_file(base_path() . '/public/' . $event->image);
      }
      $image_hash = md5_file($request->file('image')->getPathName());

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
    } else {
      $input['image'] = $event->image;
    }

    //url slug
    $url_slug = str_slug($request->input('url_slug'));
    $base_slug = $url_slug;

    $i=1; $dup=1;
    do {
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
       $tags = array();
       foreach($tag_list as $name)
       {
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
            $images_id = Gallery::firstOrCreate(array('name' => $image_name, 'image' => $public_path . $image_name))->id;
            $event_gallery = $event->gallery()->attach($images_id);
          } else {
            $error++;
          }
          $file_index++;
      }
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

    if($event->id > 0){
      return Response::json('success', array(
                  'status' => 'success',
                  'event_id'   => $event->id
              ));
    }
  }

  //admin event lists
  public function admin()
  {
    $user_id = Auth::user()->id;
    $role_id = Auth::user()->role_id;
    if($role_id == 4){//brand
      $brands = Brand::where('user_id', $user_id)->get();
      $brands_list = $brands->lists('id')->toArray();

      $events = Event::published()->active()->brandEvent($brands_list)->orderBy('events.updated_at', 'desc')->orderBy('events.created_at', 'desc')->get();

    } elseif($role_id < 4){ // manager, admin
      $brands = Brand::all();
      $events = Event::published()->active()->orderBy('events.updated_at', 'desc')->orderBy('events.created_at', 'desc')->get();
    }
    return view('events.admin', compact('events', 'role_id', 'user_id', 'brands'));
  }

  public function _locations($event)
  {
    $event = Event::findOrFail($event);
    echo json_encode($event->branch->all());
  }

  //public function locations($id)
  public function locations($slug)
  {
    $event_locations = array();
    $event_brand = array();
      //$event = Event::where('id', $id)->first();
      $event = Cache::remember('Promotion_' . $slug, 1440, function() use ($slug) {
        //return $event = Event::where('url_slug', $slug)->first();
        return Event::where('url_slug', $slug)->first();
      });

      $event_slug_id = $event->id;

      if($event->brand->count() > 0){
        $cate_name = 'ไม่ระบุหมวดหมู่';
        $cate_slug = 'unknow';
        if($event->brand->category->count() > 0){
          $cate_name = $event->brand->category->first()->name;
          $cate_slug = $event->brand->category->first()->category;
        }
        $event_brand = array('name' => $event->brand->name, 'image' => $event->brand->logo_image, 'url_slug' => $event->brand->url_slug, 'category' => $cate_name, 'category_slug' => $cate_slug);
      }

      if($event->branch->count() > 0){
        foreach($event->branch->all() as $branch){
          if($branch->events->count() == 1){
              $event_locations[$branch->lat .','. $branch->lon .','. $branch->name] = array();
          }
          $events_branch = Event::eventBranch($branch->id)->published()->active()->noExpire()->orderBy('events.created_at', 'desc')->get(); //check expire
          if($events_branch->count() < 1){
            $event_locations[$branch->lat .','. $branch->lon .','. $branch->name] = array();
            continue;
          }

          $cate_name = 'ไม่ระบุ หมวดหมู่';
          $cate_slug = 'unknow';

          foreach($events_branch as $event){
            if($event->category->count() > 0){
              $cate_name = $event->category->first()->name;
              $cate_slug = $event->category->first()->category;
            }

            //if($event->id != $id){ //without self
            if($event->id != $event_slug_id){
              if(!array_key_exists($branch->lat .','. $branch->lon . ',' . $branch->name, $event_locations)){
                $event_locations[$branch->lat .','. $branch->lon .','. $branch->name] = array(array('title' => $event->title, 'slug' => $event->url_slug, 'brand' => $event->brand->name, 'brand_slug' => $event->brand->url_slug, 'brand_logo' => $event->brand->logo_image,'image' => $event->image, 'category' => $cate_name, 'category_slug' => $cate_slug, 'start_date_thai' => $event->start_date_thai, 'end_date_thai' => $event->end_date_thai));
              } else {
                array_push($event_locations[$branch->lat .','. $branch->lon .','. $branch->name], array('title' => $event->title, 'slug' => $event->url_slug, 'brand' => $event->brand->name, 'brand_slug' => $event->brand->url_slug, 'brand_logo' => $event->brand->logo_image, 'image' => $event->image, 'category' => $cate_name, 'category_slug' => $cate_slug, 'start_date_thai' => $event->start_date_thai, 'end_date_thai' => $event->end_date_thai));
              }
            } else {
              if(!array_key_exists($branch->lat .','. $branch->lon . ',' . $branch->name, $event_locations)){
                $event_locations[$branch->lat .','. $branch->lon .','. $branch->name] = array();
              }
            }
          }
        }
      }

    echo json_encode(array('brand'=> $event_brand, 'locations' => $event_locations));
  }

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

  /* remove file */
  public function removefile($id, $image)
  {
    $image = Gallery::select('id')->where('name', $image)->get();
    if($image->first()){
      $image_id = $image->first()->id;
      $deletedRows = Event::find($id)->gallery()->detach($image_id); // delete the relationships with Image (Pivot table) first.
    }
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

  public function brand($id)
  {
    $brand = Brand::findOrFail($id);
    echo json_encode(array('branch' => $brand->branch_list, 'category' => $brand->category_list));
  }

}
