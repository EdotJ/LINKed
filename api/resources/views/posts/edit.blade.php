@extends('layouts.app')

@section('title', '| Edit Your Post')

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
                            {!!Html::linkRoute('posts.show', 'Cancel', array($post->id), array('class' => 'btn
                            btn-outline-dark'))!!}
                        </div>
                        <div class="col-sm-6">
                            {!! Form::model($post, ['route' => ['posts.update', $post->id], 'method' => 'PUT'])!!}
                            {{Form::submit('Save', ['class' => 'btn btn-outline-primary btn-block'])}}
                        </div>
                    </div>
                    <div class="col-md-8">
                        {{Form::label('name', "Title:", ["class" => 'h5 mt-3'])}}
                        {{Form::text('name', null, ["class" => 'form-control '])}}

                        {{Form::label('content', "Content:", ["class" => 'h5 mt-3'])}}
                        {{Form::textarea('content', null, ["class" => 'form-control'])}}

                        {{Form::label('job_form', "Attach the Job Form:", ["class" => 'h5 mt-3'])}}
                        {{Form::select('job_form', array('' => '', 'Job1' => 'Job1', 'Job2' => 'Job2'), ["class" => 'form-control '])}}
                        
                        <div>
                            {{Form::label('academic_group', "Add the Interest Group:", ["class" => 'h5 mt-3'])}}
                            {{Form::select('academic_group', array('' => '', 'IFF' => 'IFF', 'MA' => 'MA'), ["class" => 'form-control '])}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
