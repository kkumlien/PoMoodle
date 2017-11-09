@extends('layouts.app')

@section('content')

    <div ng-controller="StudentController as vm" class="container">

        <header>
            <h1>{{config('app.name')}}</h1>
        </header>

        <nav>
            <uib-tabset active="activeForm">
                <uib-tab heading="Home" ng-click="vm.state = 'home'"></uib-tab>
                <uib-tab heading="Trends" ng-click="vm.state = 'trends'"></uib-tab>
            </uib-tabset>
        </nav>

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

            <line-chart></line-chart>

        </div>



    </div>

@endsection