<!DOCTYPE html>
<html lang="pt">

<head>
    <!-- Head -->
    @include('layouts.common.home.head')
</head>

<body>

<!-- Header/Navbar -->
@include('layouts.common.home.navbar')

<!-- Banner Sliders -->

<main id="main">
    @yield('content-home')
</main>

<!-- Footer -->
@include('layouts.common.home.footer')

<div id="preloader"></div>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

<!-- Scripts -->
@include('layouts.scripts.home_scripts')

</body>

</html>
