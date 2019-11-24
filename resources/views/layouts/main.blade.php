@include('partials.header')
<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
    Logout
</a>
<form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>
@include('vendor.dev-crud.partials.action_notification')

@yield('content')
@include('partials.footer')
