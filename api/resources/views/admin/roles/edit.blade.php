@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right">Current role</label>

                    <div class="col-md-6">
                        <label class="col-form-label">Admin</label>
                    </div>
                </div>
                <form method="POST" class="align-content-center">
                    @csrf
                    <div class="form-group row">
                        <label for="role" class="col-md-4 col-form-label text-md-right">New role</label>

                        <div class="col-md-6">
                            <select name="role">
                                <option>Admin</option>
                                <option>Student</option>
                                <option>Lecturer</option>
                                <option>Company delegate</option>
                            </select>
                            @error('role')
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
