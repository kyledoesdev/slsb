<form method="POST" action="{{ route('profile.update', ['id' => $user->username]) }}">
    @csrf
    <div class="row">
      <div class="col-md-6">
          <div class="mb-2">
              <label class="form-label">First Name</label>
              <input class="form-control" type="text" name="building_name" placeholder="My Building"></input>
            </div>
        </div>
        <div class="col-md-6">
          <div class="mb-2">
              <label class="form-label">Last Name</label>
              <input class="form-control" type="text" name="building_name" placeholder="My Building"></input>
            </div>
        </div>
    </div>
    <div class="mb-2">
        <label class="form-label">Location</label>
        <input class="form-control" type="text" name="address" placeholder="1170 White Horse Rd."></input>
    </div>
    <div class="row mb-2">
        <div class="col-md-6">
            <label class="form-label">Birthday</label>
            <input class="form-control" type="date" name="city" placeholder="Voorhees">
        </div>
        <div class="col-md-5">
            <label class="form-label">Background Color</label>
            <input class="form-control" type="color" name="background_color" title="Select a background color for your profile page.">
        </div>
    </div>
    <div class="row m-2">
        <div class="col text-center">
            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
            <button type="submit" class="btn btn-outline-primary text-center text-black mt-2">Submit</button>
        </div>
    </div>
</form>
