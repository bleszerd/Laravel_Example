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

                <span class="d-flex">
                    <a href="/series/{{ $serie->id }}/seasons" class="btn btn-info btn-sm me-1">
                        <i class="fas fa-external-link-alt text-white"></i>
                    </a>

                    <form method="POST" action="series/destroy/{{ $serie->id }}"
                        onsubmit='return confirm("Tem certeza que deseja remover a série {{ addslashes($serie->name) }}?")'>
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" type="submit">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </span>
            </li>

        @endforeach
    </ul>
@endsection
