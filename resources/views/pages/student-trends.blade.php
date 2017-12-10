@extends('layouts.app')

@section('content')

    <script>
        var vmCourse = "{{$course}}".replace(/&quot;/g,'"');
    </script>

    <div ng-controller="StudentTrendsController as vm" class="container">

        @include('layouts.header')
        @include('layouts.menu')

        <div class="content" style="margin-bottom: 50px">

            <line-chart chart-title="vm.chartTitle" categories="vm.categories" series="vm.series"></line-chart>

        </div>

    </div>

@endsection