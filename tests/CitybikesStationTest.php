<?php

namespace Astrotomic\CitybikesTile\Tests;

use Astrotomic\CitybikesTile\CitybikesStation;
use Orchestra\Testbench\TestCase;

class CitybikesStationTest extends TestCase
{
    /** @test */
    public function it_handles_full_station(): void
    {
        $station = new CitybikesStation([
            'name' => 'Station #1',
            'free_bikes' => 5,
        ]);

        $this->assertSame('Station #1', $station->name());
        $this->assertSame(5, $station->numberOfBikesAvailable());
        $this->assertFalse($station->isEmpty());
        $this->assertFalse($station->isNearlyEmpty());
        $this->assertSame('', $station->displayClass());
    }

    /** @test */
    public function it_handles_nearly_empty_station(): void
    {
        $station = new CitybikesStation([
            'name' => 'Station #1',
            'free_bikes' => 2,
        ]);

        $this->assertSame('Station #1', $station->name());
        $this->assertSame(2, $station->numberOfBikesAvailable());
        $this->assertFalse($station->isEmpty());
        $this->assertTrue($station->isNearlyEmpty());
        $this->assertSame('text-danger', $station->displayClass());
    }

    /** @test */
    public function it_handles_empty_station(): void
    {
        $station = new CitybikesStation([
            'name' => 'Station #1',
            'free_bikes' => 0,
        ]);

        $this->assertSame('Station #1', $station->name());
        $this->assertSame(0, $station->numberOfBikesAvailable());
        $this->assertTrue($station->isEmpty());
        $this->assertTrue($station->isNearlyEmpty());
        $this->assertSame('line-through', $station->displayClass());
    }
}
