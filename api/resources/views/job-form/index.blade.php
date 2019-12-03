@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h1>List of available forms</h1> <a href="{{ route('job-forms.create') }}" class="btn btn-primary" role="button">Add new</a>
        </div>
        <hr>
        @include('success')
        @include('errors')
        <div>
            <form class="form-inline d-flex justify-content-between align-items-center">

                <label class="sr-only" for="form_name">Form name</label>
                <input type="text" class="form-control mb-2 mr-sm-2" id="form_name" name="form_name" placeholder="Form name">

                <label class="sr-only" for="creator">Creator</label>
                <input type="text" class="form-control mb-2 mr-sm-2" id="creator" name="creator" placeholder="Creator">

                <div class="form-inline d-flex align-items-center">
                    <label class="" for="date_from">Date from</label>
                    <input type="date" class="form-control ml-3" id="date_from" name="date_from" placeholder="Created after date">
                </div>

                <div class="form-inline d-flex align-items-center">
                    <label class="" for="date_to">Date to</label>
                    <input type="date" class="form-control ml-3" id="date_to" name="date_to" placeholder="Created before date">
                </div>
                <button type="submit" class="btn btn-dark btn-block mb-2">Filter</button>
            </form>
        </div>


        <ul class="list-group">
            @foreach($forms as $form)
                <li class="list-group-item mt-2 d-flex justify-content-between align-items-center">
                    <span class="w-50" >
                        <div><b>{{$form->name}}</b></div>
                        <small> <b>Created by:</b> <span class="font-italic">{{$form->user->name}}</span> </small>
                    </span>
                    <span>
                        @auth
                            @if(auth()->user()->isJobFormOwner($form->id))
                                <span>
                                    <a href="#" class="btn btn-outline-danger" role="button"
                                       onclick="deleteAction('{{ route('job-forms.destroy', $form->id) }}','{{ csrf_token() }}')">Remove</a>
                                    <a href="{{ route('job-forms.edit', $form->id) }}" class="btn btn-outline-secondary" role="button">Edit</a>
                                </span>
                            @endif
                        @endauth
                        <a href="{{ route('job-forms.show', $form->id) }}" class="btn btn-outline-primary" role="button">Fill form</a>
                    </span>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
