@extends('layout')

@section('header')
    Séries
@endsection

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post">
        @csrf
        <div class="row">
            <div class="col col-8">
                <label for="name">Nome</label>
                <input type="text" class="form-control" name="name" id="name">
            </div>

            <div class="col col-2">
                <label for="name">Quant. de Temporadas</label>
                <input type="number" class="form-control" name="qnt_seasons" id="qnt_seasons">
            </div>

            <div class="col col-2">
                <label for="name">Ep. por Temporada</label>
                <input type="number" class="form-control" name="ep_per_season" id="ep_per_season">
            </div>
        </div>

        <button class="btn btn-primary my-3">Adicionar</button>
    </form>
@endsection
