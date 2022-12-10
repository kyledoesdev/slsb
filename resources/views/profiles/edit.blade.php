@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex row justify-content-center">
            <div class="col-md-8 mb-2">
                <div class="card">
                    <div class="card-header mt-2">
                        <h1>Update Your Profile</h1>
                    </div>
                    <div class="card-body">
                        @if (!$user->isTwitchUser())
                            @include('profiles.partials.non_twitch_user')
                        @else
                            @include('profiles.partials.twitch_user')
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
