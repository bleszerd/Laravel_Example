<?php

namespace Tests\Unit;

use App\Models\Episodes;
use App\Models\Season;
use Tests\TestCase;

class SeasonTest extends TestCase
{
    /** @var Season */
    private $season;

    protected function setUp(): void
    {
        parent::setUp();
        #Create a season
        $season = new Season();

        #Create three episodes
        $episode1 = new Episodes();
        $episode2 = new Episodes();
        $episode3 = new Episodes();

        #Watch two episodes
        $episode1->watched = true;
        $episode2->watched = true;
        $episode3->watched = false;

        #Append episodes to seasons
        $season->episodes->add($episode1);
        $season->episodes->add($episode2);
        $season->episodes->add($episode3);

        $this->season = $season;
    }

    public function testGetWatchedEpisodes()
    {
        $watchedEpisodes = $this->season->getWatchedEpisodes();

        $this->assertTrue(true);
        $this->assertCount(2, $watchedEpisodes);
        foreach ($watchedEpisodes as $episode) {
            $this->assertTrue($episode->watched);
        }
    }

    public function testGetAllEpisodes()
    {
        $episodes = $this->season->episodes;

        $this->assertCount(3, $episodes);
    }
}
