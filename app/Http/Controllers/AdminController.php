<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use App\Brand;
use App\Event;

class AdminController extends Controller
{
  //admin event lists
  public function index()
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
    return view('admin.index', compact('events', 'role_id', 'user_id', 'brands'));
  }

  public function setting()
  {
    $user_id = Auth::user()->id;
    $role_id = Auth::user()->role_id;
    if($role_id == 4){//brand
      $brands = Brand::where('user_id', $user_id)->get();
    } elseif($role_id < 4){ // manager, admin
      $brands = Brand::all();
    }
    return view('admin.setting', compact('role_id', 'user_id', 'brands'));
  }
}
