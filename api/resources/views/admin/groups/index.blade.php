@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-end">
                            <a href="{{route('groups.create')}}" class="btn btn-outline-dark">
                                Create new group
                            </a>
                        </div>
                        <table class="table table-borderless w-100">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>E-mail</th>
                                <th>Suspension status</th>
                                <th>Verification status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->is_blocked ? 'Suspended' : 'Active'}}</td>
                                    <td>{{empty($user->email_verfied_at) ? 'Verified' : 'Not verified'}}</td>
                                    <td>
                                        <a href="{{route('groups.edit', $user->id)}}" class="btn btn-outline-primary">
                                            Change group
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
