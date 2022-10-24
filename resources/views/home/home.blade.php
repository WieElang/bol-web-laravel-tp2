@extends('base')

@section('content')
    @auth
        <h4>Hello {{ auth()->user()->name }}</h4>
    @else
        <h4>Hello Guest</h4>
    @endauth
@endsection