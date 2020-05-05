# A tile to display the status of CityBikes Stations

[![Latest Version on Packagist](https://img.shields.io/packagist/v/astrotomic/laravel-dashboard-citybikes-tile.svg?style=flat-square)](https://packagist.org/packages/astrotomic/laravel-dashboard-citybikes-tile)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/astrotomic/laravel-dashboard-citybikes-tile/run-tests?label=tests)](https://github.com/astrotomic/laravel-dashboard-citybikes-tile/actions?query=workflow%3Arun-tests+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/astrotomic/laravel-dashboard-citybikes-tile.svg?style=flat-square)](https://packagist.org/packages/astrotomic/laravel-dashboard-citybikes-tile)

This tile can be used on the [Laravel Dashboard](https://docs.spatie.be/laravel-dashboard) to display the status of [Citybikes](https://citybik.es/) Stations - an API for bike services all over the world.


## Installation

You can install the package via composer:

```bash
composer require astrotomic/laravel-dashboard-citybikes-tile
```

In the `dashboard` config file, you must add this configuration in the `tiles` key. The `stations` should contain the IDs of the Citybikes stations that you want to display on the dashboard.

```php
// in config/dashboard.php

return [
    // ...
    'tiles' => [
        'citybikes' => [
            'network' => 'network-href', // http://api.citybik.es/v2/networks
            'stations' => [
                // IDs
            ],
            'refresh_interval_in_seconds' => 60,
        ],
    ],
];
```

In `app\Console\Kernel.php` you should schedule the `\Astrotomic\CitybikesTile\FetchCitybikesStationsCommand` to run. You can let it run every minute if you want. You could also run it less frequently if fast updates on the dashboard aren't that important for this tile.

```php
// in app/console/Kernel.php

protected function schedule(Schedule $schedule)
{
    // ...
    $schedule->command(\Astrotomic\CitybikesTile\FetchCitybikesStationsCommand::class)->everyMinute();
}
```

## Usage

In your dashboard view you use the `livewire:citybikes-tile` component. 

```html
<x-dashboard>
    <livewire:citybikes-tile position="a1" />
</x-dashboard>
```

### Customizing the view

If you want to customize the view used to render this tile, run this command:

```bash
php artisan vendor:publish --provider="Astrotomic\CitybikesTile\CitybikesTileServiceProvider" --tag="dashboard-citybikes-tile-views"
```

## Testing

``` bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email gummibeer@astrotomic.info instead of using the issue tracker.

## Credits

- [Tom Witkowski](https://github.com/Gummibeer)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License](LICENSE.md) file for more information.
