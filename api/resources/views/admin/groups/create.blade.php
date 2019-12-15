@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <form method="POST" class="align-content-center" action="{{route('groups.store')}}">
                    @csrf
                    <div class="form-group row">
                        <label for="group" class="col-md-4 col-form-label text-md-right">Shorthand code</label>

                        <div class="col-md-6">
                            <input name="shorthand" placeholder="Group code">
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
