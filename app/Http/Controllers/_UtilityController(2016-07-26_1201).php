<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use App\Event;

class UtilityController extends Controller
{
    public function index()
    {
      echo 'Welovepro utility';
    }
    public function summary()
    {
      //echo 'Utility summary';
      $promotion = Event::orderBy('events.created_at', 'desc')->limit(10)->get();
      foreach($promotion as $pro){
        echo $pro->title . '<br />';
        echo url($pro->url_slug) . '</p>';
      }
    }
}
