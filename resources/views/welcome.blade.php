@extends('layouts.admin')
@section('content')
<style>
    .home-flujo img{
        width: 101%;
    }
    .home-flujo{
        margin: 0;
        background-image: url('img/home.png');
        background-size: 100% 100%;
        /* background-position: center; */
        background-repeat: no-repeat;
        height: calc(100vh - 94px);
    }

</style>
<div class=home-flujo>
    {{-- <img src="{{asset('img/homee.png')}}" class="imagen-presentacion"> --}}
</div>
@endsection