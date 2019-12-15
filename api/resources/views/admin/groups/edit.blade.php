@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right">Current group</label>

                    <div class="col-md-6">
                        <label class="col-form-label">{{$user->academicGroup()->first()->shorthand_code}}</label>
                    </div>
                </div>
                <form method="POST" class="align-content-center" action="{{route('groups.update', ["user" => $user])}}">
                    @csrf
                    <div class="form-group row">
                        <label for="group" class="col-md-4 col-form-label text-md-right">New group</label>

                        <div class="col-md-6">
                            <select name="group">
                                @foreach($groups as $group)
                                    <option value="{{$group->id}}" @if($user->academic_group == $group->id) selected @endif >{{$group->shorthand_code}}</option>
                                @endforeach
                            </select>
                            @error('group')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Submit') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
