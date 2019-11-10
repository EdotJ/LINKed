@extends('layouts.app')

@section('title', '| All Posts')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center">
        <h1>List of Posts</h1> <a href="{{ route('posts.create')}}" class="btn btn-lg btn-primary btn-h1-spacing">Add
            New</a>
    </div>
    <hr>
    @include('success')
    @include('errors')
    <div>
        <form class="form-inline d-flex justify-content-between align-items-center">

            <label class="sr-only" for="post_name">Post name</label>
            <input type="text" class="form-control mb-2 mr-sm-2" id="post_name" name="post_name"
                placeholder="Post name">
            <div class="form-inline d-flex align-items-center">
                <label class="" for="created_date">Created Date</label>
                <input type="date" class="form-control ml-3" id="created_date" name="created_date"
                    placeholder="Created Date">
            </div>
            <button type="submit" class="btn btn-dark btn-block mb-2">Filter</button>
        </form>
    </div>
    <ul class="list-group">
        @foreach ($posts as $post)
        <li class="list-group-item mt-2 d-flex justify-content-between align-items-center">
            <span class="w-50">
                <div><b>{{$post->name}}</b></div>
                <small> <b>Created at:</b> <span class="font-italic">{{$post->created_at}}</span> </small>
            </span>
            <span>
                <td><a href="{{route('posts.show', $post->id)}}" class="btn btn-outline-primary btn-sm">View</a></td>
                <td><a href="{{route('posts.edit', $post->id)}}" class="btn btn-outline-secondary btn-sm">Edit</a></td>
            </span>
            </tr>
            @endforeach
    </ul>
</div>
@endsection
