@extends('layouts.app')
@section('content')
@include('includes.messages')
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="card shadow p-3 rounded border border-3 border-warning">
                    <div class="card-body">
                        <div class="col text-end">
                            @if(auth()->id() != $user->getId())
                                <follow
                                    user-id="{{ $user->getId() }}"
                                    state="{{ auth()->user()->isFollowing($user) }}"
                                    followers-count="{{ count($user->followers) }}"
                                    following-count="{{ count($user->following) }}"
                                />
                            @endif
                        </div>
                        <div class="col tex-start">
                            @inject('userTypes', 'App\Models\UserType')
                            @if ($user->isAdmin() && $user == auth()->user())
                                <a href="{{ route('dashboard') }}" class="btn btn-primary rounded-pill border border-2 border-warning">Dashboard</a>
                            @endif
                        </div>
                        <div class="d-flex flex-column align-items-center text-center">
                            <img src="{{ $user->profile->avatar }}" alt="Admin" class="rounded-circle border border-5 border-warning" width="110">
                            <div class="mt-3">
                                <h3>{{ $user->username }}</h3>
                                <span class="fw-bold">{{ $user->getFullNameAttribute() != '' ? $user->getFullNameAttribute() : '' }}</span>
                                <span class="text-muted font-size-sm">{{ $user->profile->location }}</span>
                                <p class="mb-0">{{ $user->profile->bio }}</p>
                                <div class="row d-flex justify-content-center m-0 p-0">
                                    @if($user->twitch_name)
                                        <div class="mb-2 mt-1 d-inline">
                                            <a href="https://www.twitch.tv/{{$user->twitch_name}}" class="fw-bold mb-2">{{ $user->twitch_name }}</a>
                                            <i class="fa-solid fa-check-circle"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="row">
                                    <div class="col">
                                        @if(auth()->id() == $user->getId())
                                            <a class="btn btn-secondary border border-2 border-primary"
                                              href="{{ route('profile.edit', ['id' => $user->username]) }}">
                                              Edit Profile
                                            </a>
                                            <a class="btn btn-sm btn-dark border border-2 border-primary"
                                                href="{{ route('user.settings')}}">
                                                <i class="fa-solid fa-gear"></i>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4">
                        <div class="row d-flex justify-content-center">
                            <div class="col text-center m-0 p-0">
                                <followcounter
                                    followers-count="{{ count($user->followers) }}"
                                    following-count="{{ count($user->following) }}"
                                    followers-list="{{ route('user.follower_list', ['id' => $user->username]) }}"
                                    following-list="{{ route('user.following_list', ['id' => $user->username]) }}"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card shadow p-3 rounded border border-3 border-warning">
                    <div class="card-header">
                        <h2 class="mt-2 mb-1">Featured Post &#128204;</h2>
                    </div>
                    <div class="card-body border border-3 border-warning mt-2 rounded">
                        @if ($featuredPost)
                            @include('includes.markdown_content')
                        @else
                            <span>No featured post to display.</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
