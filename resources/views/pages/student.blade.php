@extends('layouts.app')

@section('content')

    <div ng-controller="StudentController as vm" class="container">

    @include('layouts.header')

<!-- link the file to this file -->
    @include('layouts.menu')

        <div id="activities" class="content">
              <button ng-click="vm.openModal()">Open Modal</button>

        </div>



    </div>

@endsection