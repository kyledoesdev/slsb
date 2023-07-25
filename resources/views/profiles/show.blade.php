@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-5 mb-2">
                <div class="card shadow px-3 pb-3 pt-1 rounded border border-3 border-dark">
                    <div class="card-body">
                        <div class="row">
                            @if($user->twitch_name)
                                <div class="col text-start">
                                    <a 
                                        target="_blank" 
                                        href="https://www.twitch.tv/{{$user->twitch_name}}" 
                                        class="d-flex fw-bold px-2" 
                                        style="text-decoration: none; cursor: pointer;"
                                    >
                                        <div class="mb-2 mt-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M2.149 0l-1.612 4.119v16.836h5.731v3.045h3.224l3.045-3.045h4.657l6.269-6.269v-14.686h-21.314zm19.164 13.612l-3.582 3.582h-5.731l-3.045 3.045v-3.045h-4.836v-15.045h17.194v11.463zm-3.582-7.343v6.262h-2.149v-6.262h2.149zm-5.731 0v6.262h-2.149v-6.262h2.149z" fill-rule="evenodd" clip-rule="evenodd"/></svg>
                                        </div>
                                        <div class="pt-1 mt-1 px-1">
                                            <i class="fa-solid fa-check-circle"></i>
                                        </div>
                                    </a>
                                </div>
                            @endif
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
                            <img src="{{ $user->profile->avatar }}" alt="Admin" class="rounded-circle border border-5 border-dark" width="110">
                            <div class="mt-3">
                                <div class="row d-flex">
                                    <div class="col-auto px-1">
                                        <h3 class="mx-1">{{ $user->username }}</h3>
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
