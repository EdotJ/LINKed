@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right">Current group</label>

                    <div class="col-md-6">
                        <label class="col-form-label">IFF-STUDENTAS</label>
                    </div>
                </div>
                <form method="POST" class="align-content-center">
                    @csrf
                    <div class="form-group row">
                        <label for="group" class="col-md-4 col-form-label text-md-right">New group</label>

                        <div class="col-md-6">
                            <select name="group">
                                <option>IFF-1</option>
                                <option>IFF-2</option>
                                <option>IFF-3</option>
                                <option>IFF-3</option>
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
