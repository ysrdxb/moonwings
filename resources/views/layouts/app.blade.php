<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moonwings | Find Cheap Flights</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

        header {
            background-color: #002147;
            padding: 12px 0;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        header a {
            color: #fff;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
        }

        header a:hover {
            text-decoration: underline;
        }

        .logo-img {
            max-width: 180px;
        }

        .search-section h1 {
            font-weight: 700;
            margin-bottom: 30px;
            font-size: 2.2rem;
        }

        .form-control,
        .form-select {
            border-radius: 8px;
            height: 50px;
        }

        .search-section {
            background-color: #002147;            
            color: #fff;
            padding: 50px 0;
        }

        .nav-tabs .nav-link {
            color: #002147;
            font-weight: 600;
        }

        .nav-tabs .nav-link.active {
            background-color: #002147;
            color: #fff;
        }

        .btn-primary {
            background-color: #002147;
            border-color: #004080;
            color: #fff;
        }
        .btn-primary:hover {
            background-color: #000000;
            color: #fff;
        }

        .bordered-form {
            border: 2px solid #002147;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        .form-control, .form-select {
            border-radius: 8px;
            height: 50px;
        }

        .btn-search {
            font-weight: 600;
            height: 50px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .btn-search:hover {
            transform: translateY(-2px);
        }        

        .feature-buttons .btn {
            background-color: #002147;
            color: #fff;
            font-size: 18px;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.3s ease;
            margin: 10px;
            padding: 10px 25px;
        }

        .feature-buttons .btn:hover {
            background-color: #004080;
            transform: translateY(-2px);
        }

        .explore-section {
            margin: 60px 0;
            text-align: center;
        }

        .explore-section h2 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 20px;
            max-width: 321px;
        }

        .explore-section button {
            color: #fff;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .explore-section button:hover {
            transform: translateY(-2px);
        }

        footer {
            background-color: #002147;
            color: #fff;
            padding: 20px 0;
            font-size: 14px;
        }

        footer a {
            color: #ccc;
            transition: color 0.3s ease;
        }

        footer a:hover {
            color: #fff;
        }

        .accordion-item {
            border: none;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .accordion-button {
            font-weight: 600;
            background-color: #f8f9fa;
        }

        .accordion-button:not(.collapsed) {
            background-color: #e9ecef;
            color: #002147;
        }

        @media (max-width: 768px) {
            .search-section h1 {
                font-size: 1.8rem;
            }

            .form-control,
            .form-select,
            .btn-search {
                height: 45px;
            }

            .feature-buttons .btn {
                font-size: 16px;
                padding: 8px 20px;
            }
        }
    </style>
    @stack('head')
</head>
<body>
    <header>
        <div class="container d-flex justify-content-between align-items-center">
            <a href="{{ route('home') }}">
                <img class="logo-img" src="{{ asset('assets/images/logo-white.png') }}" alt="Logo">
            </a>
            <div>
                <a href="#">🌐 English</a> | 
                <a href="#">❤️ Favorites</a> | 
                <a href="#">Log In</a>
            </div>
        </div>
    </header>

    @yield('content')

    @if(isset($slot)) {{ $slot }} @endif

    <footer>
        <div class="container text-center">
            <p>&copy; Moonwings 2024 - Compare flights, hotels, and car rentals worldwide.</p>
            <a href="#">Privacy Policy</a> |
            <a href="#">Cookie Policy</a> |
            <a href="#">Terms of Service</a>
        </div>
    </footer>

    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>

    @stack('scripts')
</body>
</html>