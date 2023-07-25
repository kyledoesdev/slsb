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
                    maxlength="14"
                    minlength="1"
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
                    maxlength="14"
                    minlength="1"
                    value="{{ $user->last_name }}"
                />
            </div>
        </div>
    </div>
    <div class="mb-2">
        <label class="form-label">Location</label>
        <input 
            class="form-control" 
            type="text" 
            name="location" 
            maxlength="28"
            minlength="1"
            placeholder="308 Negra Arroyo Lane" 
            value="{{ $user->profile->address }}"
        />
    </div>
    <div class="row mb-2">
        <div class="col-md-6">
            <label class="form-label">Birthday</label>
            <input 
                class="form-control" 
                type="date" 
                name="birthday" 
                placeholder="Jan 1 1970"
                value="{{ $user->profile->birthday }}"
            />
        </div>
        <div class="col-md-5">
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
    <div class="row m-2">
        <div class="col text-center">
            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
            <button type="submit" class="btn btn-outline-primary text-center text-black mt-2">Submit</button>
        </div>
    </div>
</form>
