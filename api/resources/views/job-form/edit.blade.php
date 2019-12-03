@extends('layouts.app')

@section('content')

    <div class="container mt-4">
        @include('errors')
        <form action="{{ route('job-forms.update', $jobForm->id) }}" method="post">
            @csrf
            @method('put')

            <div class="form-group">
                <label for="name">Form Name</label>
                <input type="text" class="form-control form-control" id="name" name="name" placeholder="Enter form name" value="{{$jobForm->name}}">
            </div>

            @foreach($fields as $field)
                <div class="form-group">
                    <label class="text-capitalize" for="select-{{$field}}">{{ implode(" ", explode('_', $field)) }} field</label>
                    <select class="custom-select custom-select-lg" name="{{$field}}">
                        <option disabled>Select status for {{ implode(" ", explode('_', $field)) }} field</option>
                        @foreach($statuses as $status)
                            <option @if($jobForm->$field == $status->id) selected="selected" @endif value="{{$status->id}}">{{ implode(" ", explode('_', $status->status)) }}</option>
                        @endforeach
                    </select>
                </div>
            @endforeach
            <button type="submit" class="btn btn-primary btn-block">Update</button>
        </form>
    </div>
@endsection
