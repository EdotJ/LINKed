@extends('layouts.app')


@section('content')
<div class="container">
    @include('success')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <table class="table table-borderless w-100">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th>E-mail</th>
                            <th>Suspension status</th>
                            <th>Verification status</th>
                            <th>Role</th>
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
                                <td>{{$user->role()->first()->name}}</td>
                                <td>
                                    <form class="hidden" method="POST" action="{{route('roles.block', ["user" => $user->id])}}">
                                        @csrf
                                        <a href="{{route('roles.edit', ["user" => $user->id])}}" class="btn btn-outline-primary">
                                            Change role
                                        </a>
                                        <button type="submit" class="btn btn-outline-danger">
                                            Block user
                                        </button>
                                    </form>
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
