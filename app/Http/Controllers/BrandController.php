<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\BrandRequest;

//use Auth;
use App\User;
use App\Event;
use App\Brand;
use App\Branch;
use App\Category;
use Facebook;
//use App\Branch;

class BrandController extends Controller
{
  public function __construct()
  {
    //$this->middleware('auth', ['only' => ['create', 'store']]);
    $this->middleware('auth', ['except' => ['index', 'show', 'branch']]);
  }

  /**
  * Display a list of the event.
  *
  *@return Response
  */
  public function index($brand_id)
  {
    //echo '=> ' . $brand;
    $events = Event::published()->active()->eventBrand()->BrandId($brand_id)->orderBy('events.created_at', 'desc')->paginate(15);
    return view('brand.index', compact('events'));
  }

  /**
  * Register New Brand.
  */
  public function register()
  {
    //echo 'register';
    $category = Category::select('name', 'id')->where('category_type', 'brand')->get();
    return view('brand.register', compact('category'));
  }

  public function store(BrandRequest $request)
  {
    $brand = new Brand($request->all());
    //echo '<pre>';
    //print_r($brand);
    //exit;

    //logo image
    if($request->hasFile('logo_image')){
      $image_filename = $request->file('logo_image')->getClientOriginalName();
      $file_name = pathinfo($image_filename, PATHINFO_FILENAME); // name
      $extension = pathinfo($image_filename, PATHINFO_EXTENSION); // extension
      $image_name = 'logo_'. date('Ymd-His-').str_slug($file_name) . '.' . $extension;
      $public_path = 'images/brand/';
      $destination = base_path() . '/public/' . $public_path;
      $request->file('logo_image')->move($destination, $image_name); //move file to destination
      $brand->logo_image = $public_path . $image_name; //set brand image name
    }

    //cover image
    if($request->hasFile('cover_image')){
      $image_filename = $request->file('cover_image')->getClientOriginalName();
      $file_name = pathinfo($image_filename, PATHINFO_FILENAME); // name
      $extension = pathinfo($image_filename, PATHINFO_EXTENSION); // extension
      $image_name = 'cover_'. date('Ymd-His-').str_slug($file_name) . '.' . $extension;
      $public_path = 'images/brand/';
      $destination = base_path() . '/public/' . $public_path;
      $request->file('cover_image')->move($destination, $image_name); //move file to destination
      $brand->cover_image = $public_path . $image_name; //set brand image name
    }

    //url slug
    $url_slug = str_slug($request->input('url_slug'));
    $base_slug = $url_slug;
    //echo 'base => ' . $base_slug;

    $i=1; $dup=1;
    do {
      $slug = Brand::firstOrNew(array('url_slug' => $base_slug));
      if($slug->exists){
        $base_slug = $url_slug . '-' . $i++;
      } else {
        $dup=0;
      }
    } while($dup==1);
    $brand->url_slug = $base_slug;

    $name = $request->input('name');
    $username = $request->input('username');
    $password = $request->input('password');
    $email = $request->input('email');
    if(!empty($username) && !empty($password)){
      $brand->user_id =  User::create(array('name' => $name,'username' => $username, 'password' => bcrypt($password), 'email' => !empty($email)?$email:NULL, 'role_id' => 4))->id;
    }

    $brand->save(); //brand insert

    //category
    $categoryId = $request->input('category');
    if(!empty($categoryId)){
       $brand->category()->sync($categoryId);
    }

    echo '=> ' . $brand->id; //last id inserted.
  }

  public function facebook(Request $request)
  {

    # /js-login.php
    $fb = new Facebook\Facebook([
      'app_id' => '1532458647022405',
      'app_secret' => '87129e473f042ee605b6914f4b9d5506',
      'default_graph_version' => 'v2.2',
    ]);

    $helper = $fb->getJavaScriptHelper();

    //373634482682319
    try {
      $accessToken = $helper->getAccessToken();
      //posts message on page statues
      $pageToken = $request->input('access_token');
      $msg_body = array(
        'message' => 'Test User Message !!',
        'access_token' => (string) $pageToken
      );
      try {
           $postResult = $fb->post('192272534234138/feed', $msg_body );
       } catch (FacebookApiException $e) {
           echo $e->getMessage();
       }
    } catch(Facebook\Exceptions\FacebookResponseException $e) {
      // When Graph returns an error
      echo 'Graph returned an error: ' . $e->getMessage();
      exit;
    } catch(Facebook\Exceptions\FacebookSDKException $e) {
      // When validation fails or other local issues
      echo 'Facebook SDK returned an error: ' . $e->getMessage();
      exit;
    }

    if (! isset($accessToken)) {
      echo 'No cookie set or no OAuth data could be obtained from cookie.';
      exit;
    }

    // Logged in
    echo '<h3>Access Token</h3>';
    var_dump($accessToken->getValue());

    $_SESSION['fb_access_token'] = (string) $accessToken;

    // User is logged in!
    // You can redirect them to a members-only page.
    //header('Location: https://example.com/members.php');

    $brand = new Brand($request->all());
    echo '=> ' . $request->input('title');
    echo '<pre>';
    print_r($brand);
  }

  public function branch(Request $request)
  {
    $id = $request->input('id');
    $brand = Brand::find($id);
    echo json_encode($brand->branch_list);
  }

  public function add_branch(Request $request)
  {
    //echo 'name => ' . $request->input('branch_name');
    // Getting all post data
    /*if($request->ajax()){
       echo 'name => ' . $request->json('branch_name');
      //echo '<pre>';
      //print_r($branch_name);
      //$data = $request->all();
      //print_r($data);die;
    }
    exit;*/

    $branch = new Branch;
    $branch->name = $request->json('branch_name');
    $branch->detail = $request->json('branch_detail');
    $branch->lat = $request->json('branch_lat');
    $branch->lon = $request->json('branch_lon');
    $branch->zoom = $request->json('branch_zoom');
    $branch->save();

    if($request->json('brand_id')){ //case event, brand exists and create new branch
      $brand = Brand::find($request->json('brand_id'));
      $brand->branch()->attach($branch->id);
      if($branch->id > 0){
        echo 'insert branch id => '. $branch->id;
      }
    } else {
        echo 'insert branch id => '. $branch->id;
    }
  }
}
