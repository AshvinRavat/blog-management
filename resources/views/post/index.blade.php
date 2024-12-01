@extends('layout.main')

@section('content')
  <div class="row">
       @foreach ($posts as $post)
            <div class="card" style="width: 18rem;">
            <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" alt="..." width="100px">
            <div class="card-body">
                <h5 class="card-title">
                    {{ $post->title }}
                </h5>
                <p class="card-text">
                    {{ $post->content }}
                </p>
                <form action="{{ route('post.edit', ['post' => $post->id]) }}">
                    @csrf
                    <a href="{{ route('post.edit', ['post' => $post->id]) }}" class="btn btn-primary">
                        Edit Post
                    </a>
                </form>

                <form action="{{ route('post.delete', ['post' => $post->id]) }}" method="POST">
                    @csrf
                    <button class="btn btn-danger">
                    Delete
                </button>
                </form>
            </div>
            </div>
       @endforeach  
  </div>
@endsection