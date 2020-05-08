<x-dashboard-tile :position="$position" :refresh-interval="$refreshIntervalInSeconds">
    <div class="grid grid-rows-auto-1 gap-2 h-full">
        <div class="flex justify-center items-center h-10">
            <div class="text-3xl leading-none w-10">🚲</div>
            <div class="text-xl leading-none">CityBikes</div>
        </div>
        <ul class="self-center | divide-y-2">
            @foreach($stations as $station)
                <li class="grid grid-cols-1-auto py-1">
                    <span class="truncate {{ $station->displayClass() }}" title="{{ $station->name() }}">
                        {{ $station->name() }}
                    </span>
                    <span>
                        <span class="
                            font-bold tabular-nums
                            {{ $station->isEmpty() ? 'text-dimmed' : ($station->isNearlyEmpty() ? $station->displayClass() : '') }}
                        ">
                            {{ $station->numberOfBikesAvailable() }}
                        </span>
                    </span>
                </li>
            @endforeach
        </ul>
    </div>
</x-dashboard-tile>
