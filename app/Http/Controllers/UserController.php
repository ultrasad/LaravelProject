<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\User;

class UserController extends Controller
{
    public function index()
    {
      echo 'user role => ' . Auth::User()->hasRole('Company Manager');

      //view
      /*
      @if( Auth::User()->hasRole(['Partner', 'Moder']) )
      @endif
      */

    }
}
