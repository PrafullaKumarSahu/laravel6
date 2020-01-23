<?php

namespace App\Http\Controllers\Web;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\Tag;

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
        $tags = Tag::all();
        return view('posts.create', compact('posts', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $this->validatePost($request);
        $tags = $validatedData['tags'];
        unset($validatedData['tags']);
        $post = Post::firstOrCreate($validatedData);
        $post->tags()->attach($tags);
        return back();

        //Another way can be just call validatePost() on first line and then when passing to create() just specify all fields in request() and additional data
        //$this->validatePost($request) OR $this->valdiatePost
        //Post::create(request(['title', 'description']) + ['slug' => Str::slug(request(title))]) ...
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
        $tags = Tag::all();
        return $post ? view('posts.edit', compact('post', 'posts', 'tags')) : abort('404');
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
        $validatedData = $this->validatePost($request);
        $tags = $validatedData['tags'];
        unset($validatedData['tags']);
        Post::updateOrCreate($validatedData, ['title' => $validatedData['title']]);
        $post->sync($tags);
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
            'description' => 'required',
            'tags' => 'exists:tags,id'
        ]);
        $validatedData['slug'] = Str::slug($validatedData['title']);
        $validatedData['user_id'] = 1;
        return $validatedData;
    }
}
