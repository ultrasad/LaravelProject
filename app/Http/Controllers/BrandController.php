<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\BrandRequest;

use App\Event;
use App\Brand;
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
    $category = Category::select('name', 'id')->get();
    return view('brand.register', compact('category'));
  }

  /**
  * Store a newly created resource in storage.
  *
  *@return Response
  */
  public function store(BrandRequest $request)
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

  /**
  * Display the speified resource.
  *
  *@param int $id
  *@return Response
  */
  public function branch(Request $request)
  {
    $id = $request->input('id');
    $brand = Brand::find($id);
    echo json_encode($brand->branch_list);
  }
}
