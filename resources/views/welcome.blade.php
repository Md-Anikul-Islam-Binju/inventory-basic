<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Tile Texture</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <link href="{{asset('frontend/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/assets/css/style.css')}}" rel="stylesheet">
</head>
<body>
<header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex justify-content-between">
        <div class="logo">
            <h1><a href="{{url('/')}}">Tiles Texture</a></h1>
        </div>
    </div>
</header>

@yield('content')

<script src="{{asset('frontend/assets/js/main.js')}}"></script>
</body>
</html>
