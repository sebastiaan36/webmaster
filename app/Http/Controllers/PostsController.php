<?php

namespace App\Http\Controllers;


use App\Http\Requests\StorePostsRequest;
use App\Http\Requests\UpdatePostsRequest;
use Canvas\Models\User;
use Canvas\Events\PostViewed;
use Canvas\Models\Post;
use Canvas\Models\Tag;
use Canvas\Models\Topic;

use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $posts = Post::latest()->published()->with('user', 'topic')->paginate();

        return view('post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($cat, $slug)
    {
        $post = Post::with('user', 'tags', 'topic')->firstWhere('slug', $slug);
        //get the topic from the post
        //$relatedPosts = Post::with('user', 'tags', 'topic')->get();

        $relatedPosts = Topic::with('posts')->firstWhere('slug', $post->topic[0]->slug);


        dd($relatedPosts);

        if ($post) {
            event(new PostViewed($post));

            return view('post.show', compact('post'));
        } else {
            return view('errors.404');
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Posts $posts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostsRequest $request, Posts $posts)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Posts $posts)
    {
        //
    }
}
