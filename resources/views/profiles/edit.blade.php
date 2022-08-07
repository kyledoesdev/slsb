@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex row justify-content-center">
            <div class="col-md-6 mb-2">
                <h1 class="text-center">Update Your Profile</h1>
                @if ($user->external_id == null)
                    @include('profiles.partials.non-twitch_user')
                @else
                    @include('profiles.partials.twitch_user')
                @endif
            </div>
        </div>
    </div>
@endsection
