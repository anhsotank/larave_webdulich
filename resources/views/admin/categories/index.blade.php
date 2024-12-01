@extends('layouts.app')

@section('content')
<!-- general form elements -->
<div class="card card-primary">
  <div class="card-header">
    <h3 class="card-title">List Category</h3>
  </div>
  @if ($errors->any())
    <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
    @endforeach
    </ul>
    </div>
  @endif
  <table class="table">
    <thead>
      <tr>
        <th scope="col">key</th>
        <th scope="col">Title</th>
        <th scope="col">Image</th>
        <th scope="col">Descripsion</th>
        <th scope="col">Slug</th>
        <th scope="col">Price</th>
        <th scope="col">Created_at</th>
        <th scope="col">Updated_at</th>
        <th scope="col">Status</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($categories as $key => $cate)
      <tr>
      <th scope="row">{{$key}}</th>
      <td>{{$cate->title}}</td>
      <td><img height="80" width="80" src="{{asset('uploads/categories/' . $cate->image)}}"></td>
      <td>{{$cate->descripsion}}</td>
      <td>{{$cate->slug}}</td>
      <td>{{$cate->price}}</td>
      <td>{{$cate->created_at}}</td>
      <td>{{$cate->updated_at}}</td>
      <td>
        @if ($cate->status == 1)
      <span class="text text-success">Active</span>
    @else
    <span class="text text-success"> Unactive</span>

  @endif
      </td>

      <td>
        <a href="{{route('categories.edit', [$cate->id])}}" class="btn btn-warning">Edit</a>
        <form action="{{route('categories.destroy', [$cate->id])}}" method="POST">
        @method('DELETE')
        @csrf
        <input type="submit" class="btn btn-danger" value="Xoá">
        </form>
      </td>
      </tr>
    @endforeach


      </tr>
    </tbody>
  </table>

</div>

@endsection