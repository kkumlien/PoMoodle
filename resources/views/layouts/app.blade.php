<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{asset('img/tomato-timer.png')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}"/>

    <title>{{config('app.name')}}</title>

</head>
<body>

<div ng-app="poMoodleApp" ng-strict-di>

    @yield('content')

</div>

<script src="{{asset('js/scripts.js')}}"></script>

</body>
</html>