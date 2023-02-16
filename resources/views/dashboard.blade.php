@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if (in_array(auth()->user()->userType->id, Helpers::getAdminTypeIds()))
                    <div class="card">
                        <div class="card-header">Test Markdown</div>
                            <form method="POST" action="{{ route('post.store') }}" id="create-post-form" >
                                @csrf
                                <div class="col-md-8 pt-4 px-4">
                                    <div class="mb-2">
                                        <h2 class="form-label">Create a Title<i style="color: red">*</i></h2>
                                        <input class="form-control" type="text" name="title" placeholder="My title" />
                                    </div>
                                </div>
                                <div class="col-md-8 pt-2 px-4">
                                    <div class="mb-2">
                                        <h2 class="form-label">Write up your post body</h2>
                                    </div>
                                </div>
                                <!-- Passing this value here to make validation easier on the backend -->
                                <input type="hidden" name="user_id" value="{{ auth()->id() }}"/>
                                <!-- This is the markdown editor partial -->
                                @include('includes.markdown_editor', [
                                    'action' => 'Submit',
                                    'post' => null
                                ])
                            </form>
                        </div>
                    </div>
                @else
                    Something
                @endif
            </div>
        </div>
    </div>
@endsection