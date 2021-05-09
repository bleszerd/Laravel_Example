<?php

namespace Tests\Feature;

use App\Models\Serie;
use App\Services\SeriesCreator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class SeriesCreatorTest extends TestCase
{
    public function testCreateASerie()
    {
        DB::beginTransaction();
        $serieCreator = new SeriesCreator();

        $testSerieName = 'Teste Série';

        $createdSerie = $serieCreator->createSerie($testSerieName, 2, 10);

        $this->assertInstanceOf(Serie::class, $createdSerie);
        $this->assertDatabaseHas('series', ['name' => $testSerieName]);

        $this->assertDatabaseHas('seasons', ['serie_id' => $createdSerie->id, 'number' => 1]);
        $this->assertDatabaseHas('episodes', ['number' => 1]);

        $this->assertDatabaseHas('seasons', ['serie_id' => $createdSerie->id, 'number' => 2]);
        $this->assertGreaterThanOrEqual('episodes', ['number' => 20]);
        DB::rollBack();
    }
}
