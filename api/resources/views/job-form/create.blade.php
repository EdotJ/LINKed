@extends('layouts.app')

@section('content')

    <div class="container mt-4">
        @include('errors')
        @include('success')
        <form action="{{ route('job-forms.store') }}" method="post">
            @csrf

            <div class="form-group">
                <label for="name">Form Name</label>
                <input type="text" class="form-control form-control" id="name" name="name" placeholder="Enter form name">
            </div>

            @foreach($fields as $field)
                <div class="form-group">
                    <label class="text-capitalize" for="select-{{$field}}">{{ implode(" ", explode('_', $field)) }} field</label>
                    <select id="select-{{$field}}" class="custom-select custom-select-lg" name="{{$field}}">
                        @foreach($statuses as $status)
                            <option value="{{$status->id}}"> {{ implode(" ", explode('_', $status->status)) }} </option>
                        @endforeach
                    </select>
                </div>
            @endforeach
            <button type="submit" class="btn btn-primary btn-block">Create</button>
        </form>
    </div>
@endsection
