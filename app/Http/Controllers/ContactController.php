<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function __construct()
    {
      //$this->middleware('auth', ['except' => ['index']]);
    }

    public function index()
    {
        return view('contact.index');
    }
}
