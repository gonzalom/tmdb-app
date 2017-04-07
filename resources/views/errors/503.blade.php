<!DOCTYPE html>
<html>
<head>
    <title>Be right back</title>

    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

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
        <div class="title">Be right back</div>
        <div>{{ $exception->getMessage() }}</div>
    </div>
</div>
</body>
</html>
