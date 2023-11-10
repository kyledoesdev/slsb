<input type="hidden" id="page_name" value="{{ $page_name }}"/>
<input type="hidden" id="auth_user" value="{{ auth()->check() ? auth()->user()->getGlobalData() : "{}" }}">