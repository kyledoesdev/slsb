<div class="tab-pane container fade mt-2 p-2" id="tab_3">
    @foreach ($pcParts as $id => $name)
        <pcpart
            img="{{ getPCPartImg($id) }}"
            name="{{ strtolower($name) }}"
        ></pcpart>
    @endforeach
</div>