@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3>
                    {{$user->name}}
                </h3>
            </div>
            <div class="card-body">
                <form method="POST" action="{{route('user.update', ['id' => $user->id])}}">
                    @csrf
                    @component('user.partials.profile_field')
                        @slot('title') Headline @endslot
                        @slot('type') text @endslot
                        headline
                    @endcomponent
                    @component('user.partials.profile_field')
                        @slot('title') Phone number @endslot
                        @slot('type') tel @endslot
                        number
                    @endcomponent
                    @component('user.partials.profile_field')
                        @slot('title') Birthday date @endslot
                        @slot('type') date @endslot
                        birthday
                    @endcomponent
                    @component('user.partials.profile_field')
                        @slot('title') Interests @endslot
                        @slot('type') text @endslot
                        interests
                    @endcomponent
                    <div class="form-group row">
                        <label for="description"
                               class="col-md-4 col-form-label text-md-right">Description</label>

                        <div class="col-md-6">
                            <textarea id="description" type="text"
                                   class="form-control @error('description') is-invalid @enderror"
                                   name="description" value="{{ old('description') }}"
                                      autocomplete="description" rows="5"> </textarea>

                            @error('description')
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
