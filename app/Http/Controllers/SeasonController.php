<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Illuminate\Http\Request;

class SeasonController extends Controller
{
    public function index(int $seasonId)
    {
        $seasons = Serie::find($seasonId)->seasons;

        return view('seasons.index', compact('seasons'));
    }
}
