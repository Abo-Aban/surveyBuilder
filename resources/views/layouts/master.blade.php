<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="XSRF_TOKEN" content="{{ csrf_token() }}">
    <title>Survey Builder</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/oma-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

</head>
<body>
    @include('inc.top-navigation')
    
    @yield('content')

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    
    <script src="{{ asset('js/script.js') }}"></script>
    @yield('scripts')
</body>
</html>