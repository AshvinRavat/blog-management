<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::with('category')
        ->where('user_id', auth()->user()->id)
        ->get();

        return view('post.index', ['posts' => $posts]);    
    }

    public function create(Request $request)
    {
        return view('post.create', ['categories' => Category::pluck('name', 'id') ] );
    }

    public function store(PostRequest $request)
    {
        $image = $request->file('image')->store('post/images', 'public');
        $post = $request->all();
        $post['image'] = $image; 
        $post['user_id'] = auth()->user()->id; 

        Post::create($post);

        return to_route('post.index');
    }

    public function edit(Post $post)
    {   
        return view('post.edit', [
            'post' => $post,
            'categories' => Category::pluck('name', 'id') 
        ]);
    }

    public function update(PostRequest $request, Post $post)
    {
        $image = $request->old_image;
        unset($request->old_image);

        if ($request->image)
        {
            $image = $request->file('image')->store('post/images', 'public');
            Storage::disk('public')->delete($request->old_image);
        }

        $post['image'] = $image;
        return to_route('post.index');
    }

    public function delete(Post $post)
    {
        $post->delete();
        return to_route('post.index');
    }
}
