@extends('layouts.userlayout')

@section('content')
    <section id="services">
        @if(session()->has('notice'))
            <div class="alert alert-success">
                {{ session()->get('notice') }}
            </div>
        @endif
        @if(session()->has('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
        @endif
<div class="container">
    <div class="house floating-image"></div>
    <div class="chart floating-image"></div>
    <div class="bar floating-image"></div>
    <div class="bar2 floating-image"></div>
    <div class="board floating-image"></div>
    <div class="building floating-image"></div>
    <div class="sponge floating-image"></div>
<router-view></router-view>

</div>

@endsection
