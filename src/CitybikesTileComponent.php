<?php

namespace Astrotomic\CitybikesTile;

use Livewire\Component;

class CitybikesTileComponent extends Component
{
    public string $position;

    public function mount(string $position)
    {
        $this->position = $position;
    }

    public function render()
    {
        return view('dashboard-citybikes-tile::tile', [
            'stations' => CitybikesStore::make()->stations(),
            'refreshIntervalInSeconds' => config('dashboard.tiles.citybikes.refresh_interval_in_seconds', 60),
        ]);
    }
}
