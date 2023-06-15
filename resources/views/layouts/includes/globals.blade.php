@php $page_name = isset($page_name) ? $page_name : (get_route() ? get_route() : 'default'); @endphp 
<input type="hidden" id="page_name" value="{{ $page_name }}"/>
<input type="hidden" id="auth_user_username" value="{{ auth()->hasUser() ? auth()->user()->username : null }}"/>