@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>List of filled job forms</h1>
        <hr>
        @include('success')
        @include('errors')
        <ul class="list-group">
            @foreach($forms as $form)
                <li class="list-group-item mt-2 d-flex justify-content-between align-items-center">
                    <span class="w-50" >
                        <div><b>{{$form->jobForm->name}}</b></div>
                        <small> <b>Created by:</b> <span class="font-italic">{{$form->jobForm->user->name}}</span> </small>
                    </span>
                    <span>
                        <a href="#" class="btn btn-outline-danger" role="button"
                           onclick="deleteAction('{{ route('filled-forms.destroy', $form->id) }}','{{ csrf_token() }}')">Remove</a>
                        <a href="{{ route('filled-forms.edit', $form->id) }}" class="btn btn-outline-secondary" role="button">Edit</a>
                        <a href="{{ route('filled-forms.show', $form->id) }}" class="btn btn-outline-primary" role="button">View</a>
                    </span>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
