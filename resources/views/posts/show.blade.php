@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row d-flex justify-content-center mb-2">
        <div class="col-md-12">
            @include('includes.markdown_content')
        </div>

        <div class="col-md-12">
            @include('posts.partials.comments')
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
