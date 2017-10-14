<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="img/tomato-timer.png"/>
    <link type="text/css" rel="stylesheet" href="vendor/bootstrap/bootstrap.css"/>

    <title>{{config('app.name')}}</title>

</head>
<body>

<div class="container">
    @yield('content')
</div>

</body>
</html>
