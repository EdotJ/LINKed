@extends('layouts.app')

@section('title', '| View Post')

@section('content')

<div class="container">
    @include('errors')
    @include('success')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    <div class="row float-right">
                        <div class="col-sm-6">
                            {!!Html::linkRoute('posts.edit', 'Edit', array($post->id), array('class' => 'btn
                            btn-outline-primary btn-block'))!!}
                        </div>
                        <div class="col-sm-6">
                            {{Form::open(['route' => ['posts.destroy', $post->id], 'method' => 'DELETE'])}}

                            {{Form::submit('Delete', ['class' => 'btn btn-outline-danger'])}}

                            {{Form::close()}}
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card-header">
                            <h1>{{ $post->name }}</h1>
                        </div>
                        <div class="card-body">
                            <p class="lead">{{ $post->content }}</p>
                        </div>
                        <div class="card-footer">
                            @if ($post->is_job == 1)
                            <i>This is a Job Post</i>
                            @endif
                            <p style="text-align:right">
                                <b><i> Created at {{ $post->created_at->format('d/m/Y')}} </i> </b>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
