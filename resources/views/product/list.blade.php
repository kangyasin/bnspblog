@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

          @if (\Session::has('success'))
          <div class="alert alert-success">
            <p>{{ \Session::get('success') }}</p>
          </div><br />
         @endif

          <div class="right">
            <a href="{{ url('admin/add_product') }}" class="btn btn-primary"> Add Product </a> <br><br>
          </div>
            <div class="card">
                <div class="card-header">List Product</div>

                <div class="card-body">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Nama Produk</th>
                        <th>Gambar</th>
                        <th colspan="2">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if(!empty($Products))
                      @foreach($Products as $key => $product)
                      <tr>
                        <td>{{ $key += 1 }}</td>
                        <td>{{ $product->nama_produk }}</td>
                        <td>
                            @if($product->gambar != '')
                            <img src="{{ url('products/'.$product->gambar) }}" width="100">
                            @else
                            -
                            @endif
                        </td>
                        <td> <a href="{{ url('admin/edit_product', $product->id) }}" class="btn btn-success"> Edit </a> </td>
                        <td>
                          <form action="{{ url('admin/product', $product->id) }}" method="post">
                            @csrf
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" onclick="return confirm('are you sure?')" class="btn btn-danger"> Delete </button>
                          </form>
                        </td>
                      </tr>
                      @endforeach
                      @else
                      <tr>
                        <td colspan="5" style="text-align:center;">data not found</td>
                      </tr>
                      @endif
                    </tbody>
                  </table>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
