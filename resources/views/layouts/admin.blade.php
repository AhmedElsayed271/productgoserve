@yield('style')

@include('dashboard.includes.header')


@include('dashboard.includes.navbar')

@include('dashboard.includes.aside')

<div class="content-wrapper">
    @yield('content')
</div>

@include('dashboard.includes.footer')

@yield('script')

@include('dashboard.includes.ajax')

@include('dashboard.partials._session')
@include('dashboard.partials.popup')