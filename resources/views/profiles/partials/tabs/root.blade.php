<div class="container" style="margin-top: 10px;">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="tab" href="#tab_1">
                {{ Helpers::makeUsernamePossessive($user->username ) }} posts
            </a>
        </li>
        @if ($user->isTwitchUser())
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#tab_2">
                    Favorite Games
                </a>
            </li>
        @endif
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#tab_3">
                PC Specs
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#tab_4">
                Socials
            </a>
        </li>
    </ul>
    <div class="tab-content">
        @include('profiles.partials.tabs.posts_tab')
        @include('profiles.partials.tabs.favorite_games_tab')
        @include('profiles.partials.tabs.pc_specs_tab')
        @include('profiles.partials.tabs.links_tab')
    </div>
</div>
