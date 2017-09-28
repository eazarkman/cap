@include('layouts.head')

<div class="wrapper">
    @include('layouts.header')
    @include('layouts.left')
    @yield('content')
</div>

@include('layouts.footer')