<?php

namespace Astrotomic\CitybikesTile\Tests;

use Astrotomic\CitybikesTile\CitybikesApi;
use Orchestra\Testbench\TestCase;

class CitybikesApiTest extends TestCase
{
    /** @test */
    public function it_gets_all_stations_for_given_network(): void
    {
        /** @var CitybikesApi $citybikes */
        $citybikes = $this->app->make(CitybikesApi::class);

        $stations = $citybikes->getStations('stadtrad-hamburg');

        $this->assertIsArray($stations);
        $this->assertNotEmpty($stations);

        foreach ($stations as $station) {
            $this->assertIsArray($station);
            $this->assertArrayHasKey('id', $station);
            $this->assertArrayHasKey('name', $station);
            $this->assertArrayHasKey('free_bikes', $station);
        }
    }

    /** @test */
    public function it_gets_specified_stations_for_given_network(): void
    {
        $stationIds = [
            '99374d58fdcfe7157d73a960f55809fe',
            '32b298a9544d3a87b8b764930b40ba72',
        ];

        /** @var CitybikesApi $citybikes */
        $citybikes = $this->app->make(CitybikesApi::class);

        $stations = $citybikes->getStations('stadtrad-hamburg', $stationIds);

        $this->assertIsArray($stations);
        $this->assertCount(2, $stations);

        foreach ($stations as $station) {
            $this->assertIsArray($station);
            $this->assertArrayHasKey('id', $station);
            $this->assertContains($station['id'], $stationIds);
            $this->assertArrayHasKey('name', $station);
            $this->assertArrayHasKey('free_bikes', $station);
        }
    }
}
