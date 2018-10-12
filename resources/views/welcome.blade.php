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
            padding: 0 30px;
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
        .layout-box {
            border-radius: 2px;
            box-shadow: 1px 0px 11px #ffffff;
            margin-top: 28px;
            margin: 15px 10%;
        }
        .tweet-time {
            font-size: 30px;
            color: #00a78e;
        }
        .tweet-text {
            color: white;
            padding: 20px 30px;
            margin: 0;
        }
    </style>
</head>

<body>
    <div id="application">
        <div class="container">
            <div class="layout-box tweet-text" v-bind:style="{ fontSize: tweet.fontSize + 'px' }">
                @{{ tweet.text }}
            </div>

            <div class="layout-box tweet-time">
                <span v-show="tweet.userName">
                    by
                    <strong>
                        @{{ tweet.userName }}
                    </strong>
                </span>
                @{{ tweet.from_created_at }}
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        var latestTweet = @json($tweet);
    </script>
    <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
