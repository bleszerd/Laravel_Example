@extends('layout')

@section('header')
    Séries
@endsection

@section('content')
    @if (!empty($message))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif

    <a href="{{ route('create_serie') }}" class="btn btn-dark mb-2">Adicionar</a>

    <ul class="list-group">
        @foreach ($series as $serie)
            <li class="list-group-item d-flex justify-content-between align-itens-center">
                {{ $serie->name }}
                <form method="POST" action="series/destroy/{{ $serie->id }}"
                    onsubmit='return confirm("Tem certeza que deseja remover a série {{ addslashes($serie->name) }}?")'>
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm" type="submit">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            </li>

        @endforeach
    </ul>
@endsection
