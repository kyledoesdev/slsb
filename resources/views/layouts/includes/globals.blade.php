@php $page_name = isset($page_name) ? $page_name : (Route::currentRouteName() ? Route::currentRouteName() : 'default'); @endphp 
<input type="hidden" id="page_name" value="{{ $page_name }}"/>
<input type="hidden" id="auth_user_username" value="{{ Auth::check() ? auth()->user()->username : null }}"/>