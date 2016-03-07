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
// use Illuminate\Http\Request;
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
}
