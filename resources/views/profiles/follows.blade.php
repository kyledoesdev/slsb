@extends('layouts.app')

@section('content')
    <div class="container">
        @forelse ($list as $user)
            <div class="row d-flex justify-content-center">
                @if (get_route() === 'user.follower_list')
                    <div class="col-auto">
                        <img 
                            src="{{ $user->profile->avatar}}" 
                            alt="{{ $user->username }}" 
                            height="50" 
                            width="50" 
                        />
                    </div> 
                    <h5 class="col mt-3 text-white">{{ $user->username }} ({{ $user->pivot->updated_at->format('M-d-Y') }})</h5>
                @else
                    <div class="col-auto">
                        <img 
                            src="{{ $user->profile->avatar}}" 
                            alt="{{ $user->username }}" 
                            height="50" 
                            width="50" 
                        />
                    </div>
                    <h5 class="col mt-3 text-white">{{ $user->username }} ({{ $user->pivot->updated_at->format('M-d-Y') }})</h5>
                @endif
            </div>
        @empty
            @if (get_route() === 'user.follower_list')
                <h5 class="text-white">{{ $user->username }} has no followers</h5>
            @else
                <h5 class="text-white">{{ $user->username }} is not following anyone.</h5>
            @endif
        @endforelse
    </div>
@endsection