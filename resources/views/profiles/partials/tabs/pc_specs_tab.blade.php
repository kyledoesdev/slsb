<div class="tab-pane container fade mt-2 p-2" id="tab_3" style="max-height: 500px; overflow-y: auto;">
    <pcspecs
        :profileparts="{{ $profileParts }}"
        :partslist="{{ $partsList }}"
        profileid="{{ $user->profile->id }}"
        profileusername="{{ $user->username }}"
    ></pcspecs>
</div>