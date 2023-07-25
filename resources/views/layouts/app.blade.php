@include('layouts.includes.header')

@php 
    $page_name = isset($page_name) ? $page_name : (get_route() ? get_route() : 'default'); 
    $authUsername = auth()->hasUser() ? auth()->user()->username : null;
    $user = isset($user) ? $user : null;
@endphp 

<body @if (getBgColor($user)) style="background: {{ $user->profile->background_color}}" @else class="{{ get_route() . '-background'}}" @endif>
    <div id="app">
        @include('layouts.includes.nav')
        <main class="py-4">
            @include('includes.messages')
            @yield('content')
        </main>
    </div>
</body>

@include('layouts.includes.footer')

