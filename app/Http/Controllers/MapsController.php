<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MapsController extends Controller
{
  /**
  * Display a list of the event.
  *
  *@return Response
  */
  public function index()
  {
    //$events = Event::published()->active()->eventBrand()->orderBy('events.created_at', 'desc')->paginate(15);

    //echo '<pre>';
    //print_r($events);
    //exit;

    return view('maps.index', compact('events'));
  }
}
