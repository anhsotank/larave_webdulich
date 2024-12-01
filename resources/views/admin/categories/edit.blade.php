@extends('layouts.app')

@section('content')
<!-- general form elements -->
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">edit Category</h3>
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
    <!-- /.card-header -->
    <!-- form start -->
    <form method="POST" action="{{route('categories.update', [$category->id])}}" enctype='multipart/form-data'>
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group">
                <label for="exampleInputEmail1">
                    title
                </label>
                <input type="text" name="title" value="{{$category->title}}" class="form-control"
                    id="exampleInputEmail1" placeholder="....">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Description</label>
                <input type="text" name="descripsion" value="{{$category->descripsion}}" class="form-control"
                    id="exampleInputPassword1" placeholder="....">
            </div>
            <div class="form-group">
                <label for="exampleInputFile">File image</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" name="image" class="form-control-file" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>
                    <img height="80" width="80" src="{{asset('uploads/categories/' . $category->image)}}">

                </div>
            </div>
            <div class="form-check">
                <input type="checkbox" value="1" {{ $category->status == 1 ? 'checked' : ''}} name="status"
                    class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">status</label>
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
</div>
<!-- /.card -->
@endsection