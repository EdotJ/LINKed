@extends('layouts.app')

@section('content')

    <div class="container mt-4">
        @include('errors')
        <form action="{{ route('filled-forms.store') }}" method="post">
            @csrf
            @foreach($fields as $field => $status)
                <div class="form-group">
                    @if($statuses->get($status) !== 'unused' )
                        <label class="text-capitalize" for="{{$field}}">{{ implode(" ", explode('_', $field)) }}</label>
                        <input type="text" class="form-control form-control"
                               id="{{$field}}" name="{{$field}}" placeholder="Enter {{ implode(" ", explode('_', $field)) }}"
                               value="{{ old($field) }}"
                        >
                    @endif
                </div>
            @endforeach

            <input hidden style="display: none" type="text" name="formId" value="{{ $jobFormId }}">

            <button type="submit" class="btn btn-primary btn-block">Submit</button>
        </form>
    </div>
@endsection
