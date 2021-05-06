@extends('layout')

@section('header')
    Temporadas
@endsection

@section('content')
    <ul class="list-group">
        @foreach ($seasons as $season)
            <li class="list-group-item">{{ $season->number }}</li>
        @endforeach
    </ul>
@endsection
