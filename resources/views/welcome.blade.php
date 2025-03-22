<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials.head')
</head>
<body>
    @include('partials.navbar')

    @include('users.sections.hero')
    @include('users.sections.category')
    @include('users.sections.discount')
    <main>
        @yield('content')
    </main>

    @include('partials.footer')
    @include('partials.script')
</body>
</html>
