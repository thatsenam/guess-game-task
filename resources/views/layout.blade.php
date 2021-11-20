<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Guess Game</title>

    <link href="https://shreethemes.in/landrick/landing/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="https://app.invoicepedia.com/css/materialicons.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v3.0.6/css/line.css">
    <link href="https://shreethemes.in/landrick/landing/css/style.min.css" rel="stylesheet" type="text/css"
          id="theme-opt"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/gh/jquery-form/form@4.3.0/dist/jquery.form.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"
            integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="{{ asset('style.css') }}">


</head>
<body class="antialiased">
<div class="wrapper">
    <div class="row main-content align-items-center justify-content-center">
        <div class="col-12 ">
            <div class="card ">
                <div class="card-body ">
                    @yield('content')

                </div>
            </div>
        </div>
    </div>
</div>
</body>
@yield('js')
<script src="{{ asset('index.js') }}"></script>
</html>
