@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col align-self-center">
                @if(!isset($user))
                    <h1 class="text-dark text-center">
                        User does not exist!
                    </h1>
                    <h3 class="text-dark text-center">
                        Y U TRY BAD UZER?
                    </h3>
                @else
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-row align-content-center justify-content-between">
                                <div class="">
                                <span class="profile-name">
                                    {{$user->name}}
                                </span>
                                    <a href="mailto:{{$user->email}}" class="profile-email">
                                        {{$user->email}}
                                    </a>
                                </div>
                                @if(Auth::user()->id == $user->id)
                                    <a href="{{route('user.edit', ['id' => Auth::user()->id])}}">
                                        <span class="fa fa-pen"></span>
                                        Edit profile
                                    </a>
                                @endif
                            </div>
                            <h5 class="text-muted mt-1">
                                {{($user->headline)}}
                            </h5>
                        </div>
                    </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <div class="container p-0">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="container p-0">
                                        @component('user.partials.profile_column')
                                            @slot('label') Phone @endslot
                                            {{$user->phone_number}}
                                        @endcomponent

                                        @component('user.partials.profile_column')
                                            @slot('label') Birthday @endslot
                                            {{$user->birthday}}
                                        @endcomponent
                                        {{-- TODO: ADD IF FOR STUDENT ROLE --}}
                                        @component('user.partials.profile_column')
                                            @slot('label') Academic group @endslot
                                            {{-- TODO: ADD ACADEMIC GROUP --}}
                                        @endcomponent

                                        @component('user.partials.profile_column')
                                            @slot('label') Year (Course) @endslot
                                            {{-- TODO: ADD COURSE --}}
                                        @endcomponent

                                        @component('user.partials.profile_column')
                                            @slot('label') Study programme @endslot
                                            {{-- TODO: ADD Study programme --}}
                                        @endcomponent

                                        @component('user.partials.profile_column')
                                            @slot('label') Company @endslot
                                            {{-- TODO: ADD Company --}}
                                        @endcomponent

                                        @component('user.partials.profile_column')
                                            @slot('label') Title @endslot
                                            {{-- TODO: ADD Title for professors / delegates --}}
                                        @endcomponent

                                        @component('user.partials.profile_column')
                                            @slot('label') Interests @endslot
                                            {{-- TODO: ADD Interests --}}
                                        @endcomponent
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 mb-3">
                            <div class="card h-100 ">
                                <div class="card-body">
                                    <div class="container h-100 d-flex flex-column">
                                        <div class="row">
                                            <div class="col">
                                                <p>Description</p>
                                                <hr>
                                            </div>
                                        </div>
                                        <div class="row flex-grow-1">
                                            <div class="col profile-description-box">
                                                <p class="profile-description-text">{{$user->description}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    </div>
    </div>
    </div>

@endsection()
