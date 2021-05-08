@extends('layout')

@section('header')
    Temporadas
@endsection

@section('content')
    <ul class="list-group">
        @foreach ($seasons as $season)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href="/seasons/{{ $season->id }}/episodes">
                    Temporada {{ $season->number }}
                </a>
                <span class="badge bg-secondary">
                    {{ $season->getWatchedEpisodes()->count() }} / {{ $season->episodes->count() }}
                </span>
            </li>
        @endforeach
    </ul>
@endsection
