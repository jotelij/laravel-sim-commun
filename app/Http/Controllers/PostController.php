<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Inertia\Inertia;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('user')
        ->withCount('comments', 'reactions')
        ->latest()
        ->paginate(10)
        ->withQueryString();

        return Inertia::render('posts/Index', [
            'posts' => $posts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return Inertia::render('posts/Create', []);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $data = $request->validated();
        $user = auth()->user();

        // create a new post associated with the user
        $user->posts()->create($data);

        // Success
        session()->flash('alert', [
            'type' => 'success',
            'message' => 'Record created successfully!'
        ]);
    
        // return redirect()->route('posts.index')->with('success', 'Post created successfully.');
        return redirect()->route('posts.index')->with(
            'alert', [
                'type' => 'success',
                'message' => 'Record created successfully!'
            ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $post->load('user', 'comments', 'comments.user')->loadCount('reactions', 'comments');
        // dd($post);
        return Inertia::render('posts/Show', [
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $post->load('user');

        $user = auth()->user();

        // Only allow the article owner to delete
        if (! $user || $user->id !== $post->user_id) {
            abort(403);
        }

        return inertia('posts/Edit', [
            'post' => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $user = auth()->user();

        // Only allow the article owner to delete
        if (! $user || $user->id !== $post->user_id) {
            abort(403);
        }

        Post::where('id', $post->id)->update([
            'content' => $request->validated()['content']
        ]);

        return redirect()->route('posts.show', $post)->with('message', 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }

    
    /**
     * Store the new post's comment in storage.
     */
    public function comment(Post $post, StoreCommentRequest $request)
    {
        $data = $request->validated();
        $user = auth()->user();

        // create a new comment associated with the post and user
        $post->comments()->create(array_merge($data, ['user_id' => $user->id]));

        // return redirect()->route('posts.index')->with('success', 'Post created successfully.');
        return redirect()->route('posts.show', $post)->with('message', 'Comment created successfully.');
    }

     /**
     * Display a listing of user post  resource.
     */
    public function my_index()
    {
        $user = auth()->user();

        // Only allow the article owner to delete
        if (!$user) {
            abort(403);
        }

        $posts = $user->posts()->with('user')->withCount('comments', 'reactions')->latest()->get();

        return Inertia::render('posts/MyIndex', [
            'posts' => $posts
        ]);
    }
}
