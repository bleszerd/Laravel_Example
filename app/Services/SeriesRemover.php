<?php

namespace App\Services;

use App\Models\{Episodes, Season, Serie};
use Illuminate\Support\Facades\DB;

class SeriesRemover
{
    private int $serieId;
    private string $serieName;

    public function removeSerie(int $id): string
    {
        $this->serieId = $id;

        DB::transaction(function () {
            $serie = Serie::find($this->serieId);
            $this->serieName = $serie->name;

            $this->removeSeason($serie->seasons);
        });

        return $this->serieName;
    }

    private function removeSeason($season)
    {
        $season->each(function (Season $season) {
            $this->removeEpisodes($season->episodes);

            $season->delete();
        });

        Serie::destroy($this->serieId);
    }

    private function removeEpisodes($episodes)
    {
        $episodes->each(function (Episodes $episode) {
            $episode->delete();
        });
    }
}
