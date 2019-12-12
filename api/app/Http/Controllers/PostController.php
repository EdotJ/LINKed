<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Filters\PostsFilter;

class PostController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PostsFilter $filters)
    {
        return view('posts.index', [
            'posts' => Post::filter($filters)->get(),
         ]);
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

    public function store(Request $request)
    {
        // validation
        $request->validate([
            'name' => 'required|unique:posts|max:255',
            'content' => 'required|max:500',
        ]);
        
        //store in the db
        $post = new Post;
        $post->name = $request->name;
        $post->content = $request->content;
        $post->is_job = $request->input('job_form') ? 1 : 0;
        $post->save();

        return redirect()->route('posts.show', $post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('posts.show', [
            'post' =>  Post::find($id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('posts.edit', [
            'post' =>  Post::find($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         // validation
         $request->validate([
            'name' => 'required|max:255',
            'content' => 'required|max:500',
        ]);
        
        //store in the db
        $post = Post::find($id);
        $post->name = $request->input('name');
        $post->content = $request->input('content');
        $post->is_job = $request->input('job_form') ? 1 : 0;
       
        $post->save();

        return redirect()->route('posts.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('posts.index');
    }
}
