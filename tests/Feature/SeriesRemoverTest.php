<?php

namespace Tests\Feature;

use App\Models\Serie;
use App\Services\SeriesCreator;
use App\Services\SeriesRemover;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class SeriesRemoverTest extends TestCase
{
    private Serie $serie;

    protected function setUp(): void
    {
        parent::setUp();

        DB::beginTransaction();
        $serieCreator = new SeriesCreator();
        $this->serie = $serieCreator->createSerie('Teste Serie Delete', 2, 2);
    }

    public function testRemoveSerie()
    {
        $this->assertDatabaseHas('series', ['name' => 'Teste Serie Delete', 'id' => $this->serie->id]);
        
        $serieRemover = new SeriesRemover();
        $deletedSerieName = $serieRemover->removeSerie($this->serie->id);
        $this->assertIsString($deletedSerieName);
        $this->assertEquals('Teste Serie Delete', $this->serie->name);
        $this->assertDatabaseMissing('series', ['id' => $this->serie->id]);
        DB::rollBack();
    }
}
