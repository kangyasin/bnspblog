<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use File;
use App\Http\Requests\ArticleRequest;
use Exception;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $Articles = Article::get();
        return view('article/list', compact('Articles'));
    }

    public function add_article(){
        return view('article/add');
    }

    public function edit_article($id){

        $article = Article::findOrFail($id);
        return view('article/edit', compact('article', 'id'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        $validated = $request->validated();

        $image = '';
        if ($request->hasfile('image'))
        {
          $file = $request->file('image');
          // original name image = Mawar.jpg
          // time() = 837498374
          // output = 837498374Mawar.jpg as $image
          $image = time() . $file->getClientOriginalName();
          $file->move(public_path() . '/images/', $image);
        }
        $validated['image'] = $image;
        $article = Article::create($validated);

        // $article = new Article;
        // $article->title = $request->get('title');
        // $article->description = $request->get('description');
        // $article->image = $image;
        // $article->save();

        return redirect('admin/article')->with('success', 'article saved');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, $id)
    {

      $validated = $request->validated();
      $article = Article::find($id);

      $image = '';
      if ($request->hasfile('image'))
      {
        // for check image not null
        if($article->image != null || $article->image != '')
        {
          // get location image from public folder
          $pathImage = public_path() . '/images/' .$article->image;
          // check image exists on public/images folder ?
          if(File::exists($pathImage)){
            // if exists delete image from public/images folder
            File::delete($pathImage);
          }
        }

        $file = $request->file('image');
        // original name image = Mawar.jpg
        // time() = 837498374
        // output = 837498374Mawar.jpg as $image
        $image = time() . $file->getClientOriginalName();
        $file->move(public_path() . '/images/', $image);
      }

        $validated['image'] = $image;
        $article->update($validated);

        // $article->title = $request->get('title');
        // $article->description = $request->get('description');
        // $article->image = $image;
        // $article->update();

        return redirect('admin/article')->with('success', 'Data updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::find($id);
        if($article->image != null || $article->image != '')
        {
          $pathImage = public_path() . '/images/' .$article->image;
          if(File::exists($pathImage)){
            File::delete($pathImage);
          }
        }
        $article->delete();
        return redirect('admin/article')->with('success', 'Data deleted');

    }
}
