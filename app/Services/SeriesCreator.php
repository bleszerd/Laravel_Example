<?php

namespace App\Services;

use App\Models\Serie;
use Illuminate\Support\Facades\DB;

class SeriesCreator
{
    private Serie $serieCreated;

    public function createSerie(string $name, int $seasons, int $episodes): Serie
    {
        DB::transaction(function () use (&$name, $episodes, $seasons) {
            $this->serieCreated = Serie::create([
                'name' => $name
            ]);

            for ($i = 1; $i <= $seasons; $i++) {
                $season = $this->serieCreated->seasons()->create(['number' => $i]);

                for ($j = 1; $j <= $episodes; $j++) {
                    $season->episodes()->create(['number' => $j]);
                }
            }
        });

        /* Better alternative */
        // DB::beginTransaction();
        //     $serieCreated = Serie::create([
        //         'name' => $name
        //     ]);

        //     for ($i = 1; $i <= $seasons; $i++) {
        //         $season = $serieCreated->seasons()->create(['number' => $i]);

        //         for ($j = 1; $j <= $episodes; $j++) {
        //             $season->episodes()->create(['number' => $j]);
        //         }
        //     }
        // DB::commit();
        /* Finall of better alternative */

        return $this->serieCreated;
    }
}
