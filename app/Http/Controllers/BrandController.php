<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\Brand;
//use App\Branch;

class BrandController extends Controller
{
  public function __construct()
  {
    //$this->middleware('auth', ['only' => ['create', 'store']]);
    $this->middleware('auth', ['except' => ['index', 'show', 'branch']]);
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
