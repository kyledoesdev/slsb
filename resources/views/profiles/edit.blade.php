@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex row justify-content-center">
            <div class="col-md-8 mb-2">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col d-flex jsutify-content-start pt-2">
                                <h1>Update Your Profile</h1>
                            </div>
                            <div class="col d-flex justify-content-end pt-2">
                                <i class="fa-regular fa-circle-question" title="All profile fields are optional."></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if ($user->isTwitchUser())
                            @include('profiles.partials.twitch_user')
                        @else
                            @include('profiles.partials.non_twitch_user')
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
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
@endpush
