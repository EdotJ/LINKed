@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h3>Disable your account</h3>
                <hr>
                <p>
                    THIS ACTION WILL DISABLE YOUR ACCOUNT
                </p>
                <a href="#" class="btn btn-danger" role="button"
                   onclick="deleteAction('{{ route('settings.disable') }}','{{ csrf_token() }}')">Disable account</a>
            </div>
        </div>
    </div>
@endsection
