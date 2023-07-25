<form method="POST" action="{{ route('profile.update', ['id' => $user->username]) }}">
    @csrf
    <div class="row">
      <div class="col-md-6">
          <div class="mb-2">
                <label class="form-label">First Name</label>
                <input 
                    class="form-control" 
                    type="text" 
                    name="first_name" 
                    placeholder="Walt"
                    value="{{ $user->first_name }}"
                />
            </div>
        </div>
        <div class="col-md-6">
          <div class="mb-2">
                <label class="form-label">Last Name</label>
                <input 
                    class="form-control" 
                    type="text" 
                    name="last_name" 
                    placeholder="White"
                    value="{{ $user->last_name }}"
                />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 mb-2">
            <label class="form-label">Location</label>
            <input 
                class="form-control" 
                type="text" 
                name="location" 
                placeholder="308 Negra Arroyo Lane"
                value="{{ $user->profile->location }}"
            />
        </div>
        <div class="col-md-4">
            <label class="form-label">Background Color</label>
            <input 
                class="form-control" 
                type="color" 
                name="background_color" 
                title="Select a background color for your profile page." 
                value="{{ $user->profile->background_color}}"
            />
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-md-5">
            <label class="form-label">Birthday</label>
            <input 
                class="form-control" 
                type="date" 
                name="birthday" 
                placeholder="Jan 1 1970"
                value="{{ $user->profile->birthday }}"
            />
        </div>
        <div class="col">
            <label class="form-label">Avatar Type</label>
            @include('profiles.partials.avatar_types')
            <span class="text-muted"></span>
        </div>
        <div class="col">
            <label class="form-label">Avatar Seed</label>
            <input 
                class="form-control" 
                type="text" 
                name="seed" 
                placeholder="{{ $user->username }}"
            />
            <a 
                class="mb-0 text-muted" 
                style="text-decoration: none" 
                href="{{ route('about.avatars')}}"
            >
                More info here
            </a>
        </div>
    </div>
    <div class="form-group">
        <label for="notes">Bio</label>
        <textarea 
            class="form-control" 
            maxlength="256" 
            oninput="displayCharsLeft(this, 256)"
            name="bio" 
            rows="5"
            placeholder="Follow me on twitch!"
        ></textarea>
      <div class="d-inline mb-2" id="charsLeft"></div>
    </div>
    <div class="row m-2">
        <div class="col text-center">
            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
            <button type="submit" class="btn btn-outline-primary text-center text-black">Update</button>
        </div>
    </div>
</form>