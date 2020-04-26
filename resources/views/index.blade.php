@extends('DashboardModule::base')

@section('title','Dashboard')

@section('stylesheets')
    @parent
    <link rel="stylesheet" href="{{ mix('vendor/css/RevisionModule.css','') }}">
@endsection

@section('sidebar')
    @include('DashboardModule::sidebar.index', ['menu' => Selene\Support\Facades\MenuRepository::getPresences()])
@endsection

@section('content')
    <div class="content-wrapper" id="app">
        <div class="row">
            <div class="col-12">
                @include('RevisionModule::revisions')
            </div>
        </div>
    </div>
@endsection

@section('javascripts')
    @parent
    <script src="{{ mix('vendor/js/RevisionModule.js') }}"></script>
@endsection
