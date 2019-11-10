<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();

        return view('posts.index')->withPosts($posts);
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
        if($request->input('job_form'))
        {
            $post->is_job =  1;
        }
        else
        {
            $post->is_job =  0;
        }

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
        $post = Post::find($id);
        return view('posts.show')->withPost($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        
        return view('posts.edit')->withPost($post);
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

        if($request->input('job_form'))
        {
            $post->is_job =  1;
        }
        else
        {
            $post->is_job =  0;
        }
       
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
        $post = Post::find($id);
        $post->delete();

        return redirect()->route('posts.index');
    }
}
