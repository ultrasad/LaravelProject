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
    $paginate = 20;
    if($role_id == 4){//brand
      $brands = Brand::where('user_id', $user_id)->get();
      $brands_list = $brands->lists('id')->toArray();

      //$events = Event::published()->active()->brandEvent($brands_list)->orderBy('events.updated_at', 'desc')->orderBy('events.created_at', 'desc')->get();
      $events = Event::published()->active()->brandEvent($brands_list)->orderBy('events.created_at', 'desc')->paginate($paginate);

    } elseif($role_id < 4){ // manager, admin
      $brands = Brand::all();
      $events = Event::published()->active()->orderBy('events.created_at', 'desc')->paginate($paginate);
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

  public function events(Request $request)
  {
    //echo($request->input('test'));

    /*$start = isset($request['start'])?$request['start']:0;
		$info['PerPage'] = isset($request['length'])?$request['length']:20;
		if($start == 0){
			$pageNo = 1;
		} else if($start == 20) {
			$pageNo = 2;
      //echo 'start => ' . $start . '<br />';
      //echo 'pageNo => ' . $pageNo . '<br />';
		} else {
			$pageNo = ($start/20)+1;
		}*/

    $user_id = Auth::user()->id;
    $role_id = Auth::user()->role_id;
    $paginate = 20;
    if($role_id == 4){//brand
      $brands = Brand::where('user_id', $user_id)->get();
      $brands_list = $brands->lists('id')->toArray();
      $events = Event::published()->active()->brandEvent($brands_list)->orderBy('events.created_at', 'desc')->paginate($paginate);

    } elseif($role_id < 4){ // manager, admin
      //$brands = Brand::all();
      $events = Event::published()->active()->orderBy('events.created_at', 'desc')->paginate($paginate);
    }

    $totaldata = $events->total();
    $totalfiltered = $totaldata;
    $data = array();

    foreach($events as $event){
      $btn_action = "
        <div id='btn_confirm' style='display:'>
          <a href='javascript:void(0);' onclick='deleteEvent({$event->id});' class='btn btn-delete-action btn-success btn-xs'><i class='fa fa-check hidden-xs'></i> Y</a>
          <a href='javascript:void(0);' onclick='toggleDel(this);' class='btn btn-delete-action btn-danger btn-xs'><i class='fa fa-times hidden-xs'></i> N</a>
        </div>
        <div id='btn_action' style='display:none'>
          <a href='/events/{$event->id}/edit' class='btn btn-edit-action btn-complete btn-xs'><i class='fa fa-magic hidden-xs'></i> Edit</a>
          <a href='javascript:void(0);' onclick='toggleDel(this);' class='btn btn-delete-action btn-danger btn-xs'><i class='fa fa-exclamation hidden-xs'></i> Del</a>
        </div>
      ";
      $nestedData=array();
      $nestedData[] = '&nbsp;';
      $nestedData[] = $btn_action;
      $nestedData[] = $event->title;
      $nestedData[] = $event->brand->name;
      $nestedData[] = $event->start_date_thai;
      $nestedData[] = $event->end_date_thai;
      $data[] = $nestedData;
    }

    $draw = isset($request['draw'])?$request['draw']:1;
    $json_data = array(
			"draw" => intval( $draw ),
			"recordsTotal" => intval( $totaldata ),
			"recordsFiltered" => intval( $totalfiltered ),
			"data"  => $data
		);
		echo json_encode($json_data);
  }
}
