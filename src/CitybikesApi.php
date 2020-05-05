<?php

namespace Astrotomic\CitybikesTile;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class CitybikesApi
{
    public function getStations(string $network, array $stationIds = []): array
    {
        $networkHref = Str::start($network, '/v2/networks/');
        $stations = Http::get('http://api.citybik.es'.$networkHref)->json();

        return collect($stations['network']['stations'] ?? [])
            ->when($stationIds, function (Collection $stations) use ($stationIds): Collection {
                return $stations
                    ->filter(fn (array $station) => in_array($station['id'], $stationIds))
                    ->values()
                    ->mapWithKeys(fn (array $station) => [array_search($station['id'], $stationIds) => $station]);
            })
            ->toArray();
    }
}
