@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <ul class="list-group">
                        @foreach ($posts as $post)
                        <li class="list-group-item mt-2 d-flex justify-content-between align-items-center">
                            <span class="w-50">
                                <div><b>{{$post->name}}</b></div>
                                <div>{{$post->content}}</div>
                                <small> <b>Created at:</b> <span class="font-italic">{{$post->created_at->format('d/m/Y')}}</span> </small>
                            </span>
                            @if ($post->is_job == 1)
                            <span>
                                <td><a href="{{route('posts.show', $post->id)}}"
                                        class="btn btn-outline-primary btn-sm">Apply</a></td>
                            </span>
                            @endif
                            </tr>
                            @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
