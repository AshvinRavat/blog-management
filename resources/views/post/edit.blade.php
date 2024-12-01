@extends('layout.main')

@section('content')
    <div class="container border mt-4 ml-2 col-4 p-2">
        <form action="{{ route('post.update', ['post' => $post->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Select Category</label>
    <select name="category_id" class="form-control">
    
        @foreach ($categories as $id => $category)
            <option value="{{ $id }}" @selected($post->category_id == $id)>
                {{ $category }}
            </option>
        @endforeach
    </select>
    @error('category_id')
        <span class="text-danger">
            {{ $message }}
        </span>
    @enderror
  </div>

  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Title</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="title"
    value="{{ old('title', $post->title) }}">
    @error('title')
        <span class="text-danger">
            {{ $message }}
        </span>
    @enderror
  </div>

  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">content</label>
    <textarea  class="form-control" id="exampleInputPassword1" name="content">
        {{ old('content', $post->content ) }}
    </textarea>

    @error('content')
        <span class="text-danger">
            {{ $message }}
        </span>
    @enderror
  </div>

    <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Image</label>
    <input type="file" class="form-control" id="exampleInputPassword1" name="image">
    <input type="text" class="form-control" disabled value="{{ $post->image }}" >
    <input type="hidden" class="form-control" value="{{ $post->image }}" name="old_image">
        
    @error('image')
        <span class="text-danger">
            {{ $message }}
        </span>
    @enderror
  </div>
  
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
    </div>
@endsection