@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if (in_array(auth()->user()->userType->id, Helpers::getAdminTypeIds()))
                    <div>
                        <dashboard 
                            storeroute="{{ route('post.store') }}"
                        />
                    </div>
                @else
                    Something
                @endif
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script></script>
@endpush