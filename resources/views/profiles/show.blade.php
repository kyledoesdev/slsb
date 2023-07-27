@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-5 mb-2">
                <div class="card shadow px-3 pb-3 pt-1 rounded border border-3 border-dark">
                    <div class="card-body">
                        <div class="row">
                            <div class="col text-end">
                                @if(auth()->check() && auth()->id() != $user->id)
                                    <follow
                                        user-id="{{ $user->id }}"
                                        state="{{ auth()->user()->isFollowing($user) }}"
                                        followers-count="{{ count($user->followers) }}"
                                        following-count="{{ count($user->following) }}"
                                    />
                                @endif
                            </div>
                        </div>
                        <div class="d-flex flex-column">
                            <img 
                                src="{{ $user->profile->avatar }}" 
                                class="rounded-circle border border-5 border-dark" 
                                width="110"
                            />
                            <div class="mt-3">
                                <div class="row d-flex">
                                    <div class="col-auto px-1">
                                        <div class="row d-flex">
                                            <div class="col-auto mr-0 pr-0">
                                                <h3 class="mx-2">{{ $user->username }}</h3>
                                            </div>
                                            @if ($user->twitch_name)
                                                <div class="col-auto pt-1 mt-1 px-1">
                                                    <i class="fa-solid fa-check-circle"></i>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row d-flex">
                                    <div class="col-auto pb-1">
                                        <span class="fw-bold">{{ $user->full_name != '' ? $user->full_name : '' }}</span>
                                    </div>
                                </div>
                                <div class="row d-flex">
                                    <div class="col-auto">
                                        @if (isset($user->profile->location))
                                            <i class="fa-solid fa-location-dot"></i> <span class="text-muted font-size-sm">{{ $user->profile->location}}</span> |
                                        @endif
                                        @if ($user->profile->birthday != null)
                                            <i class="fa-solid fa-cake-candles"></i> {{ $user->profile->getBirthday() }} |
                                        @endif
                                        <span>Joined: {{ $user->joinedAt() }}</span>
                                    </div>
                                </div>
                                <section>
                                    <followcounter
                                        followers-count="{{ count($user->followers) }}"
                                        following-count="{{ count($user->following) }}"
                                        followers-list="{{ route('user.follower_list', ['id' => $user->username]) }}"
                                        following-list="{{ route('user.following_list', ['id' => $user->username]) }}"
                                    />
                                </section>
                                <hr>

                                <p class="mb-2">{{ $user->profile->bio }}</p>
                            </div>
                        </div>
                        <hr class="my-4">
                        <div class="row d-flex justify-content-center">
                            <div class="col mx-2 p-0">
                                <likecounter like-count="{{ $user->getAllLikes() }}"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 mb-2">
                <div class="card shadow p-3 rounded border border-3 border-dark">
                    @include('profiles.partials.tabs.root')
                </div>
            </div>
            <div class="col-lg-12">
                @if ($featuredPost)
                    <div class="col-lg-12 border border-3 border-dark mt-2 mb-2 rounded" style="max-height: 600px;">
                        @include('includes.markdown_content', ['post' => $featuredPost])
                    </div>
                @else
                    <div class="card card-body border border-3 border-dark mt-2 rounded">
                        <h5 class="mx-2 mt-2 mb-0">{{ $user->username }} has no featured post. &#128204;</h5 >
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
