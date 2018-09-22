<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Gamja+Flower" rel="stylesheet">

    <style>
        html {
            height: 90%;
        }
        body {
            color: azure;
            background-color: black;
            font-family: 'Gamja Flower', cursive;
            height: 100%;
        }
        .container {
            display: flex;
            justify-content: center;
            flex-direction: column;
            text-align: center;
            height: 100%;
            width: 50%;
        }
        #application {
            height: 100%;
        }
    </style>
</head>
<body>
    <div id="application">
        <div class="container">
            <div id="twiter-user-twit">
                @{{ twit.text }}
                @{{ twit.created_at }}
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
