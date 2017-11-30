@extends('layouts.app')

@section('content')

    <div ng-controller="StudentController as vm" class="container">

        @include('layouts.header')
        @include('layouts.menu')

        <div class="content">

            <div class="chart-selection">
                <div class="btn-group">
                    <label uib-btn-radio="'column'" ng-model="vm.chart.type" class="btn btn-primary">
                        Bar Chart
                    </label>
                    <label uib-btn-radio="'pie'" ng-model="vm.chart.type" class="btn btn-primary">
                        Pie Chart
                    </label>
                </div>
            </div>

            <chart chart-title="Courses" data="vm.chart.data" type="vm.chart.type"></chart>

            <script>
                var course = "{{$user}}".replace(/&quot;/g,'"');
                console.log(JSON.parse(course));
            </script>

            <line-chart></line-chart>

        </div>



    </div>

@endsection