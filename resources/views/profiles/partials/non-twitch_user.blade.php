<form method="POST" action="{{ route('profile.update', ['id' => $user->username]) }}">
    @csrf
    <div class="row">
      <div class="col-md-6">
          <div class="mb-2">
              <label class="form-label">First Name</label>
              <input class="form-control" type="text" name="first_name" placeholder="Walt"></input>
            </div>
        </div>
        <div class="col-md-6">
          <div class="mb-2">
              <label class="form-label">Last Name</label>
              <input class="form-control" type="text" name="last_name" placeholder="White"></input>
            </div>
        </div>
    </div>
    <div class="mb-2">
      <label class="form-label">Location</label>
      <input class="form-control" type="text" name="location" placeholder="Earth, Milkyway"></input>
    </div>
    <div class="row mb-2">
      <div class="col-md-5">
        <label class="form-label">Birthday</label>
        <input class="form-control" type="date" name="birthday" placeholder="Voorhees">
       </div>
      <div class="col">
        <label class="form-label">Avatar Type</label>
        @include('profiles.partials.avatar_types')
        <span class="text-muted"></span>
      </div>
      <div class="col">
          <label class="form-label">Avatar Seed</label>
          <input class="form-control" type="text" name="seed" placeholder="{{ $user->username }}">
          <a class="mb-0 text-muted" style="text-decoration: none" href="{{ route('about.avatars')}}">More info here</a>
        </div>
    </div>
    <div class="form-group">
      <label for="notes">Bio</label>
      <textarea class="form-control" maxlength="256" oninput="displayCharsLeft(this, 256)" name="bio" rows="5"
        placeholder="xQcL"></textarea>
      <div class="d-inline mb-2" id="charsLeft"></div>
    </div>
    <div class="row m-2">
      <div class="col text-center">
        <button type="submit" class="btn btn-outline-primary text-center text-black">Update</button>
      </div>
    </div>
</form>

@section('scripts')
    <script>
        /**
         * Take an HTML Input field (textfield, textarea etc) and a char count ex 150
         * And display the how many chars the user can still type, as they type.
         */
        function displayCharsLeft(element, countFrom) {
            var textInput = element.value.length;
            var charactersLeft = countFrom - textInput;
            document.getElementById('charsLeft').innerHTML = "Characters left: " + charactersLeft;
        }
    </script>
@endsection
