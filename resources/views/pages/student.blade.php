@extends('layouts.app')

@section('content')

    <div ng-controller="StudentController as vm">

        <header>
            <h1>{{config('app.name')}}</h1>
        </header>

        <div class="nav container">
            <uib-tabset active="activeForm">
                <uib-tab index="0" heading="Home" ng-click="vm.state = 'data-entry'"></uib-tab>
                <uib-tab index="1" heading="Charts" ng-click="vm.state = 'charts'"></uib-tab>
            </uib-tabset>
        </div>

        <div class="content container">

            <student-data-entry ng-if="vm.state == 'data-entry'"></student-data-entry>
            <student-charts ng-if="vm.state == 'charts'"></student-charts>

        </div>

    </div>

@endsection