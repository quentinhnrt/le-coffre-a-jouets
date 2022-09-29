<!doctype html>
<html {!! get_language_attributes() !!}>
<head>
    <meta charset="{{ get_bloginfo('charset') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    @head
</head>
<body @php(body_class())>

    @include('partials.header')

    <main id="main" class="site-main">
        @yield('content')
    </main>

    @include('partials.footer')

    @footer

</body>
</html>
