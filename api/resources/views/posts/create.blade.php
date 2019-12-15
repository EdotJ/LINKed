@extends('layouts.app')

@section('title', '| Create New Post')

@section('content')
<div class="container">
    @include('errors')
    @include('success')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create New Post') }}</div>
                <div class="card-body">
                    {!! Form::open(array('route' => 'posts.store')) !!}
                    {{Form::label('name', "Give Your Post a Name:", array('style' => 'margin-left: 10px;'))}}
                    {{Form::text('name', null, array('class' => 'form-control', 'style' => 'margin-bottom: 10px; margin-left: 10px;'))}}

                    {{Form::label('content', "What Do You Want to Share?", array('style' => 'margin-left: 10px;'))}}
                    {{Form::textarea('content', null, array('class' => 'form-control', 'style' => 'margin-bottom: 10px; margin-left: 10px;'))}}

                    {{Form::label('job_form', "Attach the Job Form:", array('style' => 'margin-left: 10px;'))}}
                    {{Form::select('job_form', ['' => ''] + $forms->pluck('name', 'id')->toArray(), null,  array('class' =>'form-control', 'style' => 'margin-bottom: 10px; margin-left: 10px;'))}}
                    <div>
                        {{Form::submit("Create", array('class' =>'btn btn-primary', 'style' => 'margin-top: 10px; margin-left: 10px;'))}}
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    @endsection
