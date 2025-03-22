<!DOCTYPE html>
<html lang="en">
    <head>
        <title>
            @isset($brandData)
                Trigo - {{ $brandData->name }}
            @else
                Trigo - @yield('title', 'Home')
            @endisset
        </title>
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
@include('home.partials.head')
<body>
    @include('home.partials.header')
    <main class="main">
        @yield('content')
    </main>
    @include('home.partials.footer')

    <!-- JavaScript Files -->
    <script src="{{ asset('template/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('template/assets/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Replace the local Owl Carousel with CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="{{ asset('template/assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('template/assets/js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('template/assets/js/main.js') }}"></script>
    <!-- Initialization Script -->
    <script>
        $(document).ready(function() {
            $('.intro-slider').owlCarousel({
                nav: false,
                dots: true,
                responsive: {
                    768: {
                        nav: true,
                        dots: false
                    }
                }
            });
            $('.owl-carousel').owlCarousel({
                nav: true,
                dots: true,
                margin: 20,
                loop: false,
                responsive: {
                    0: { items: 2 },
                    600: { items: 2 },
                    992: { items: 3 },
                    1200: { items: 4 }
                }
            });
        });
    </script>
</body>
</html>