<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="user-id" content="{{ auth()->user() ? auth()->user()->id : '' }}">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    @if (isset($styles) && is_array($styles) && count($styles) > 0)
        @foreach ($styles as $style)
            <link href="{{ $style }}" rel="stylesheet" type="text/css" />
        @endforeach
    @endif

    @yield('styles')
</head>

<body>
<div class="bg-white p-0">
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->

    <header>
        @include('layouts._main._header')
    </header>

    @if(Session::has('message'))
        <section class="ftco-section" id="notifications">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="{{ Session::get('message')['class'] }}">

                            <div class="d-flex">
                                <div class="alert-icon">
                                    <i class="{{ Session::get('icon')['class'] }}"></i>
                                </div>
                                <p class="mb-0 ml-2"><b>{{ Session::get('alert')['text'] }}
                                        <div class="text-center">
                                            {{ Session::get('message')['text'] }}
                                        </div>
                                </p>
                            </div>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true"><i class="ion-ios-close"></i></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <main>
        @yield('content')
    </main>


    <footer>
    @include('layouts._main._footer')
    </footer>

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
</div>

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('lib/wow/wow.min.js') }}"></script>
<script src="{{ asset('lib/easing/easing.min.js') }}"></script>
<script src="{{ asset('lib/waypoints/waypoints.min.js') }}"></script>
<script src="{{ asset('lib/counterup/counterup.min.js') }}"></script>
<script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('lib/tempusdominus/js/moment.min.js') }}"></script>
<script src="{{ asset('lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
<script src="{{ asset('lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>

<!-- Template Javascript -->
<script src="{{ asset('js/main.js') }}"></script>

@if (isset($scripts) && is_array($scripts) && count($scripts) > 0)
    @foreach ($scripts as $script)
        <script src="{{ $script }}"></script>
    @endforeach
@endif
@yield('scripts')
</body>
</html>
