@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('errors')
            @if(!Auth::check() || !Auth::user()->isDisabled())
            <div class="card">
              <div class="card-header">Dashboard</div>
                  <ul class="list-group">
                      @foreach ($posts as $post)
                      @if (!auth()->user() || $post->academic_group_id == auth()->user()->academic_group) 
                      <li class="list-group-item mt-2 d-flex justify-content-between align-items-center">
                          <span class="w-50">
                              <div><b>{{$post->name}}</b></div>
                              <div>{{$post->content}}</div>
                              <small> <b>Created at:</b> <span
                                      class="font-italic">{{$post->created_at->format('d/m/Y')}}</span> </small>
                          </span>
                          @if ($post->is_job == 1)
                          <span>
                              <td><a href="{{route('job-forms.show', $post->form_id)}}"
                                      class="btn btn-outline-primary btn-sm">Apply</a></td>
                          </span>
                          @endif
                      </li>
                      @endif
                      @endforeach
                  </ul>
              </div>
            </div>
            @elseif(!Request::is('home') )
            <div class="alert alert-danger" role="alert">
            You have disabled your account. Please contact the Administrators to re-enable it.
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
