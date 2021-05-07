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
                <span id="name-serie-{{ $serie->id }}">
                    {{ $serie->name }}
                </span>

                <div class="input-group w-50" hidden id="input-name-serie-{{ $serie->id }}">
                    <input type="text" class="form-control" value="{{ $serie->name }}">
                    <div class="input-group-append">
                        <button class="btn btn-primary ms-1" onclick="handleEditSerie({{ $serie->id }})">
                            <i class="fas fa-check"></i>
                        </button>
                        @csrf
                    </div>
                </div>

                <span class="d-flex">
                    <span>
                        <button class="btn btn-primary btn-sm me-1" type="button"
                            onclick="handleInputEdit({{ $serie->id }})">
                            <i class="fas fa-edit"></i>
                        </button>
                    </span>
                    <span>
                        <a href="/series/{{ $serie->id }}/seasons" class="btn btn-info btn-sm me-1">
                            <i class="fas fa-external-link-alt text-white"></i>
                        </a>
                    </span>
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

    <script>
        function handleInputEdit(serieId) {
            //Select elements
            const titleEl = document.querySelector(`#name-serie-${serieId}`)
            const formEl = document.querySelector(`#input-name-serie-${serieId}`)

            if (!titleEl.hasAttribute('hidden')) {
                //Hide title and show input
                titleEl.setAttribute('hidden', true)
                formEl.removeAttribute('hidden')
            } else {
                //Hide input and show title
                titleEl.removeAttribute('hidden')
                formEl.setAttribute('hidden', true)
            }
        }

        function handleEditSerie(serieId) {
            const formData = new FormData();

            const serieName = document.querySelector(`#input-name-serie-${serieId} > input`).value
            const token = document.querySelector('input[name="_token"]').value

            formData.append('name', serieName)
            formData.append('_token', token)

            const url = `/series/edit/${serieId}`

            fetch(url, {
                method: 'POST',
                body: formData,
            }).then(() => {
                handleInputEdit(serieId)
                document.querySelector(`#name-serie-${serieId}`).textContent = serieName
            })
        }

    </script>
@endsection
