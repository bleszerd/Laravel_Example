<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Episodes;
use App\Models\Season;
use Illuminate\Http\Request;
use App\Models\Serie;
use App\Services\SeriesCreator;
use App\Services\SeriesEditor;
use App\Services\SeriesRemover;
use SebastianBergmann\Environment\Console;

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

    public function store(SeriesFormRequest $request, SeriesCreator $seriesCreator)
    {
        $serieCreated = $seriesCreator->createSerie(
            $request->name,
            $request->qnt_seasons,
            $request->ep_per_season
        );

        $request->session()->flash(
            'message',
            "Série {$serieCreated->name} criada com sucesso!"
        );

        return redirect()->route('list_series');
    }

    public function destroy(Request $request, SeriesRemover $seriesRemover)
    {
        $serieName = $seriesRemover->removeSerie($request->id);

        $request->session()->flash(
            'message',
            "Série {$serieName} removida com sucesso!"
        );

        return redirect()->route('list_series');
    }

    public function edit(Request $request, int $id)
    {
        $newSerieName = $request->name;
        $serie = Serie::find($id);
        $serie->name = $newSerieName;
        $serie->save();
    }
}
