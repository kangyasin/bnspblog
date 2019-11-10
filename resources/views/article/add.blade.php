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
                <div class="card-header">Add Article</div>

                <div class="card-body">
                  <form action="{{ url('/admin/article') }}" method="post" enctype="multipart/form-data">
                      @csrf
                      <div class="row">
                        <div class="form-group col-md-4">
                          <label for="Title">Title</label>
                          <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-md-4">
                          <label for="Description">Description</label>
                          <textarea name="description" class="form-control" required>{{ old('description') }}</textarea>
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
