@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
          <div class="right">
            <a href="{{ url('admin/add_article') }}" class="btn btn-primary"> Add Article </a> <br><br>
          </div>
            <div class="card">
                <div class="card-header">List Article</div>

                <div class="card-body">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th colspan="2">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if(!empty($Articles))
                      @foreach($Articles as $key => $article)
                      <tr>
                        <td>{{ $key += 1 }}</td>
                        <td>{{ $article->title }}</td>
                        <td>
                            @if($article->image != '')
                            <img src="{{ url('images/'.$article->image) }}" width="100">
                            @else
                            -
                            @endif
                        </td>
                        <td> <a href="{{ url('admin/edit_article', $article->id) }}" class="btn btn-success"> Edit </a> </td>
                        <td>
                          <form action="{{ url('admin/article', $article->id) }}" method="post">
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
