<?php

namespace Astrotomic\CitybikesTile;

use Illuminate\Console\Command;

class FetchCitybikesStationsCommand extends Command
{
    protected $signature = 'dashboard:fetch-citybikes-stations';
    protected $description = 'Fetch Citybikes Stations';

    public function handle(CitybikesApi $citybikes): void
    {
        $this->info('Fetching Citybikes stations...');

        $stations = $citybikes->getStations(
            config('dashboard.tiles.citybikes.network'),
            config('dashboard.tiles.citybikes.stations', [])
        );

        CitybikesStore::make()->setStations($stations);

        $this->info('All done!');
    }
}
