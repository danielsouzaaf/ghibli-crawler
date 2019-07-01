<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Ghibli Crawler</title>

    </head>
    <body>
    <redoc spec-url="{{ asset('doc/swagger.yaml') }}"></redoc>

    <script src="{{asset('js/redoc.standalone.js')}}"></script>
    </body>
</html>
