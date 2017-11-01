@extends('layouts.app')

@section('content')

    <div ng-controller="StudentController as vm">

        <header>
            <h1>{{config('app.name')}}</h1>
        </header>

        <div class="nav container">
            <uib-tabset active="activeForm">
                <uib-tab heading="Home" ng-click="vm.state = 'home'"></uib-tab>
                <uib-tab heading="Trends" ng-click="vm.state = 'trends'"></uib-tab>
            </uib-tabset>
        </div>

        <div class="content container">

            <student-home ng-if="vm.state == 'home'"></student-home>
            <student-trends ng-if="vm.state == 'trends'"></student-trends>

        </div>

    </div>

@endsection