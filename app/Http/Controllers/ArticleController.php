<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['create', 'store', 'edit', 'update', 'destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("articles/index", ['articles' => Article::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('components/form', ['article' => new Article()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $article = new Article($request->validate(Article::$validation_rules));
        $article->user_id = Auth::id();
        
        $article->save();
        foreach ($request->images as $image) {
            $newImage = new Image();
            $newImage->article_id = $article->id;
            $newImage->path = Storage::disk('public')->put("images", $image);
            $newImage->save();
        }
        return redirect()->route("home");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view("articles/show", ["article" => Article::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::findOrFail($id);
        if (!$this->isCurrentUserArticleOwner($article)) {
            return redirect()->route("home");
        }
        return view("components/form", ["article" => $article]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);
        if (!$this->isCurrentUserArticleOwner($article)) {
            return redirect()->route("home");
        }
        $article->update($request->validate(Article::$update_validation_rules));
        return redirect()->route("articles.show", ["article" => $article->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        if (!$this->isCurrentUserArticleOwner($article)) {
            return redirect()->route("home");
        }
        $article->delete();
        return redirect()->route("profile");
    }

    private function isCurrentUserArticleOwner(Article $article) {
        return Auth::id() == $article->user_id;
    }
}
