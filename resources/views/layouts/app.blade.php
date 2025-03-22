<!DOCTYPE html>
<html lang="en">

<head>
    @include('home.partials.head')
    
    <script src="{{ asset('js/sweetalert2.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">
</head>

<body>
    @include('home.partials.header')

    <main>
        @yield('content')
    </main>

    @include('home.partials.footer')
    {{-- @include('home.partials.script') --}}
    <script>
        $(document).ready(function() {
    $('.btn-quickview').click(function(e) {
        e.preventDefault();
        var productId = $(this).data('product-id');
        $.get('/popup/quickView/' + productId, function(data) {
            $('body').append(data); // Append the modal HTML
            $('#quickViewModal-' + productId).modal('show'); // Show the modal
        });
    });
});
    </script>
</body>

</html>
