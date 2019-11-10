@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

          @if($errors->any())
              <div class="alert alert-danger">
                  <p><strong>Opps Something went wrong</strong></p>
                  <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
                  </ul>
              </div>
          @endif

            <div class="card">
                <div class="card-header">Edit Produk</div>

                <div class="card-body">
                  <form action="{{ url('/admin/product', $product->id) }}" method="post" enctype="multipart/form-data">
                      <!-- cross-site request forgery (csrf)-->
                      @csrf
                      <input type="hidden" name="_method" value="PUT">

                      <div class="row">
                        <div class="form-group col-md-4">
                          <label for="Title">Nama Produk</label>
                          <input type="text" name="nama_produk" class="form-control" value="{{ $product->nama_produk }}" required>
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-4">
                          <label for="Description">Deskripri</label>
                          <textarea name="deskripsi" class="form-control" required> {{ $product->deskripsi }} </textarea>
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-4">
                          @if($product->gambar != '')
                            <img src="{{ url('product/'.$product->gambar) }}" width="100">
                          @endif
                          <input type="file" name="gambar">
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-4">
                          <button type="submit" class="btn btn-success"> Update </button>
                        </div>
                      </div>

                  </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
