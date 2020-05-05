<?php

namespace Astrotomic\CitybikesTile;

use Illuminate\Support\Collection;
use Spatie\Dashboard\Models\Tile;

class CitybikesStore
{
    private Tile $tile;

    public static function make()
    {
        return new static();
    }

    public function __construct()
    {
        $this->tile = Tile::firstOrCreateForName('citybikes');
    }

    public function setStations(array $stations): self
    {
        $this->tile->putData('stations', $stations);

        return $this;
    }

    public function stations(): Collection
    {
        return collect($this->tile->getData('stations') ?? [])
            ->map(fn (array $attributes) => new CitybikesStation($attributes));
    }
}
