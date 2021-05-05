<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Serie;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function index(Request $request)
    {
        $series = Serie::query()->orderBy('name')->get();
        $message = $request->session()->get('message');

        return view('series.index', compact('series', 'message'));
    }

    public function create(Request $request)
    {
        return view('series.create');
    }

    public function store(SeriesFormRequest $request)
    {
        $name = $request->name;
        $serieCreated = Serie::create([
            'name' => $name
        ]);

        # $serieCreated = Serie::create($request -> all())

        $request->session()->flash(
            'message',
            "Série {$serieCreated->name} criada com sucesso!"
        );

        return redirect()->route('list_series');
    }

    public function destroy(Request $request)
    {
        Serie::destroy($request->id);
        $request->session()->flash(
            'message',
            "Série {$request->name} removida com sucesso!"
        );

        return redirect()->route('list_series');;
    }
}
