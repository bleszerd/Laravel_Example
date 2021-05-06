<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use Illuminate\Http\Request;
use App\Models\Serie;
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

    public function store(SeriesFormRequest $request)
    {
        $serieCreated = Serie::create([
            'name' => $request->name
        ]);

        $qntSeasons = $request->qnt_seasons;

        for ($i = 1; $i <= $qntSeasons; $i++) {
            $season = $serieCreated->seasons()->create(['number' => $i]);

            for ($j = 1; $j <= $request->ep_per_season; $j++) {
                $season->episodes()->create(['number' => $j]);
            }
        }

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
