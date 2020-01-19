<?php

namespace App\Http\Controllers\Web;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->paginate(10);
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $posts = Post::latest()->paginate(10);
        return view('posts.create', compact('posts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Post::firstOrCreate($this->validatePost($request));
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $posts = Post::latest()->paginate(10);
        return $post ? view('posts.show', compact('post', 'posts')) : abort('404');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $posts = Post::latest()->paginate(10);
        return $post ? view('posts.edit', compact('post', 'posts')) : abort('404');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        Post::updateOrCreate($this->validatePost($request), ['title' => $this->validatePost($request)['title']]);
        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }

    public function validatePost(request $request)
    {
        $validatedData = request()->validate([
            'title' => 'required|unique:posts,id|max:255',
            'description' => 'required'
        ]);
        $validatedData['slug'] = Str::slug($validatedData['title']);

        // dd($validatedData);
        return $validatedData;
    }
}
