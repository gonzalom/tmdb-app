<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
    <meta name="robots" content="noindex,nofollow" />
    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('favicons/favicon-32x32.png') }}">
    <link rel="manifest" href="{{ asset('favicons/manifest.json') }}">
    <link rel="mask-icon" href="{{ asset('favicons/safari-pinned-tab.svg') }}" color="#01d277">
    <meta name="theme-color" content="#081c24">

    <style>
        html, body {
            height: 100%;
        }

        body {
            margin: 0;
            padding: 10px;
            width: 100%;
            color: #B0BEC5;
            display: table;
            font-weight: 100;
            font-family: 'Lato';
        }

        .container {
            text-align: center;
            display: table-cell;
            vertical-align: middle;
        }

        .content {
            text-align: center;
            display: inline-block;
        }

        .logo {
            margin-bottom: 48px;
        }

        .title {
            font-size: 72px;
            margin-bottom: 48px;
        }

        .back-link {
            margin-top: 48px;
        }

        .back-link A, .back-link A:hover, .back-link A:visited, .back-link A:link, .back-link A:hover {
            color: #B0BEC5;
        }

    </style>
</head>
<body>
<div class="container">
    <div class="content">
        <div class="logo">
            <a href="{{ Request::root() }}">
                <img src="{{ asset('images/208x226-stacked-blue.png') }}" width="208" height="226" alt="{{ config('app.name', 'The Move Database') }}" />
            </a>
        </div>
        <div class="title">{{ $title }}</div>
        <div>{{ $description }}</div>
        @if (!empty($message))
            <div style="margin-top:30px">{{ $message }}</div>
        @endif
        <div class="back-link"><a href="{{ Request::root() }}" title="Back to home page">Back to home page</a></div>
    </div>
</div>

</body>
</html>
