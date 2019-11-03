@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Add Article</div>

                <div class="card-body">
                  <form action="{{ url('/admin/article') }}" method="post" enctype="multipart/form-data">
                      @csrf
                      <div class="row">
                        <div class="form-group col-md-4">
                          <label for="Title">Title</label>
                          <input type="text" name="title" class="form-control" required>
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-4">
                          <label for="Description">Description</label>
                          <textarea name="description" class="form-control" required></textarea>
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-4">
                          <input type="file" name="image">
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-4">
                          <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                      </div>

                  </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
