<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
     $Products = Product::get();
      return view('product/list', compact('Products'));
  }

  public function add_product(){
      return view('product/add');
  }

  public function edit_product($id){

      $product = Product::findOrFail($id);
      return view('product/edit', compact('product', 'id'));

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
  public function store(ProductRequest $request)
  {
      $validated = $request->validated();

      $gambar = '';
      if ($request->hasfile('gambar'))
      {
        $file = $request->file('gambar');
        // original name gambar = Mawar.jpg
        // time() = 837498374
        // output = 837498374Mawar.jpg as $gambar
        $gambar = time() . $file->getClientOriginalName();
        $file->move(public_path() . '/products/', $gambar);
      }
      $validated['gambar'] = $gambar;
      $product = Product::create($validated);

      // $product = new Product;
      // $product->title = $request->get('title');
      // $product->description = $request->get('description');
      // $product->gambar = $gambar;
      // $product->save();

      return redirect('admin/product')->with('success', 'product saved');

  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Product  $product
   * @return \Illuminate\Http\Response
   */
  public function show(Product $product)
  {
      //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Product  $product
   * @return \Illuminate\Http\Response
   */
  public function edit(Product $product)
  {
      //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Product  $product
   * @return \Illuminate\Http\Response
   */
  public function update(ProductRequest $request, $id)
  {

    $validated = $request->validated();
    $product = Product::find($id);

    $gambar = '';
    if ($request->hasfile('gambar'))
    {
      // for check gambar not null
      if($product->gambar != null || $product->gambar != '')
      {
        // get location gambar from public folder
        $pathImage = public_path() . '/products/' .$product->gambar;
        // check gambar exists on public/products folder ?
        if(File::exists($pathImage)){
          // if exists delete gambar from public/products folder
          File::delete($pathImage);
        }
      }

      $file = $request->file('gambar');
      // original name gambar = Mawar.jpg
      // time() = 837498374
      // output = 837498374Mawar.jpg as $gambar
      $gambar = time() . $file->getClientOriginalName();
      $file->move(public_path() . '/products/', $gambar);
    }

      $validated['gambar'] = $gambar;
      $product->update($validated);

      // $product->title = $request->get('title');
      // $product->description = $request->get('description');
      // $product->gambar = $gambar;
      // $product->update();

      return redirect('admin/product')->with('success', 'Data updated');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Product  $product
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
      $product = Product::find($id);
      if($product->gambar != null || $product->gambar != '')
      {
        $pathImage = public_path() . '/products/' .$product->gambar;
        if(File::exists($pathImage)){
          File::delete($pathImage);
        }
      }
      $product->delete();
      return redirect('admin/product')->with('success', 'Data deleted');

  }
}
