<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Post\CreatePostsRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Model\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index')->with('posts', Post::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostsRequest $request)
    {
        //Upload the image
        $image = $request->image->store('posts');

        //Create the post
        Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'image' => $image,
            'published_at' => $request->published_at
        ]);

        //Flash a message
        session()->flash('success', 'Post created successfully!');

        //Redirect the user
        return redirect(route('posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.create')->withPost($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        //Get only the attributes that I want [Security]
        $data = $request->only([ 'title', 'description', 'content', 'published_at' ]);

        //Check if new image
        if ($request->hasFile('image')) {
            //Upload it
            $image = $request->image->store('posts');

            //Delete old one
            $post->deleteImage();

            //Store the new one
            $data['image'] = $image;
        }

        //Update attributes
        $post->update($data);

        //Flash message
        session()->flash('success', 'Post updated successfully!');

        //Redirect user
        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        //Find Post
        $post = Post::withTrashed()->where('id', $id)->firstOrFail();

        //Delete post
        if ($post->trashed()) {
            //Delete image file
            $post->deleteImage();

            //Delete post
            $post->forceDelete();
            $flashMessage = 'Post deleted successfully!';
        } else {
            //Trash post
            $post->delete();
            $flashMessage = 'Post trashed successfully!';
        }

        session()->flash('success', $flashMessage);

        return redirect(route('posts.index'));
    }

    /**
     * Display a list of all trashed posts
     *
     * @return \Illuminate\Http\Response
     */
    public function trashed()
    {
        //Fetch trashed posts
        $trashed = Post::onlyTrashed()->get();

        //Redirect
        //After the 'with' method, laravel know that the variable name is 'posts'
        return view('posts.index')->withPosts($trashed)->withTrashedPage(true);
    }

    /**
     * Restore trashed posts
     *
     * @return \Illuminate\Http\Response
     */
    public function restore(int $id)
    {
        //Find Post
        $post = Post::withTrashed()->where('id', $id)->firstOrFail();

        //Restore Post
        $post->restore();

        session()->flash('success', 'Post restored successfully!');

        return redirect()->back();
    }
}
