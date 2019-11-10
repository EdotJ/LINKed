@extends('layouts.app')

@section('content')

    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h1> Filled {{ $form->jobForm->name }} form </h1>
            </div>
            <div class="card-body d-flex flex-wrap justify-content-between align-items-start w-100">
                @foreach($fields as $field => $value)
                    <div class="w-25 m-3 d-flex flex-column align-items-start">
                        <b class="text-capitalize">{{ implode(" ", explode('_', $field)) }}</b>
                        {{ $value }}
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection








