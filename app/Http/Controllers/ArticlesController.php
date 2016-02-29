<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

//use App\Models\Article as Articles;
use App\Article;
// use Illuminate\Http\Request;
use Request; //use Request replace Illuminate\Http\Request
use App\Http\Requests\ArticleRequest;

class ArticlesController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth', ['only' => ['create', 'store']]);
      //$this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
    * Display a list of the resource.
    *
    *@return Response
    */

    public function index()
    {
      /*
      $articles = Article::lastest('published_at')
                          ->published()
                          ->get();
      //dd($articles); //dump and die
      return view('article.index', compact('articles'));
      //return $articles; //return json object
      */

      $articles = Article::published()->get(); //pass scopePublished scope
      return view('articles.index', compact('articles'));
    }

    /**
    * Show the form for creating a new resource.
    *
    *@return Response
    */
    public function create()
    {
        return view('articles.create');
    }

    /**
    * Store a newly created resource in storage.
    *
    *@return Response
    */

    /*public function store()
    {
        $input = Request::all();
        Article::create($input);
        return redirect('articles');
    }*/

    public function store(ArticleRequest $request)
    {

       $input = $request->all();
       Article::create($input);
       return redirect('articles');
    }

    /**
    * Display the speified resource.
    *
    *@param int $id
    *@return Response
    */
    public function show($id)
    {
      //echo '=> ' . $id;

      $article = Article::find($id);
      if(empty($article))
        abort(404);

      //echo '<pre>';
      //print_r($article);

      //dd($article);
      return view('articles.show', compact('article'));
    }

    /**
    * Show the form for editing the specified resource.
    *
    *@param int $id
    *@return Response
    */
    public function edit($id)
    {
      $article = Article::find($id);
      if(empty($article))
        abort(404);
      return  view('articles.edit', compact('article'));
    }

    /**
    * Update the specified resource in storage.
    *
    *@param int $id
    *@return Response
    */
    public function update($id, ArticleRequest $request)
    {
      $article = Article::findOrFail($id);
      $article->update($request->all());
      return redirect('articles');
    }

    /**
    * Remove the specifiled resource from storege.
    *
    *@param int $id
    *@return Response
    */
    public function destroy($id)
    {
      $article = Article::findOrFail($id);
      $article->delete();
      return redirect('articles');
    }
}
