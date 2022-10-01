# A collection of tiles to display football data.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/VictorAvelar/laravel-dashboard-football-data-advanced.svg?style=flat-square)](https://packagist.org/packages/VictorAvelar/laravel-dashboard-football-data-advanced)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/VictorAvelar/laravel-dashboard-football-data-advanced/run-tests?label=tests)](https://github.com/VictorAvelar/laravel-dashboard-football-data-advanced/actions?query=workflow%3Arun-tests+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/VictorAvelar/laravel-dashboard-football-data-advanced.svg?style=flat-square)](https://packagist.org/packages/:vendor/laravel-dashboard-football-data-advanced)

Laravel dashboard tiles to display matches, results, standings and more football data stats. 

This tile can be used on [the Laravel Dashboard](https://docs.spatie.be/laravel-dashboard).

## Installation

You can install the package via composer:

```bash
composer require victoravelar/laravel-dashboard-football-data-advanced
```

## Configuration

```php
// in config/dashboard.php

return [
    // other settings
    'tiles' => [
        // other tiles ...
        'football_data_advanced' => [
            /*
            |--------------------------------------------------------------------------
            | Football-data.org API KEY
            |--------------------------------------------------------------------------
            |
            | In order to fetch the data an API key is required, get yours at 
            | https://www.football-data.org/client/register.
            | The API is provided in a FREMIUM model thus the information to be
            | displayed is limited by your own API plan.
            |
            */
            'api-key' => env('FOOTBALL_DATA_API_KEY', ''),

            /*
            |--------------------------------------------------------------------------
            | Future lookup limit.
            |--------------------------------------------------------------------------
            |
            | Sets the limit to look forward for upcoming matches, the max. suggested
            | value is 1 week as the space for displaying is limited and most of the
            | values will not fit the available tile space.
            |
            */
            'future' => '2 days',

            /*
            |--------------------------------------------------------------------------
            | Past lookup limit.
            |--------------------------------------------------------------------------
            |
            | Sets the limit to look backwards for resutls, the max. suggested
            | value is 1 week as the space for displaying is limited and most of the
            | values will not fit the available tile space.
            |
            | The value must be a strtotime valid string without sign.
            |
            | See: https://www.php.net/manual/en/function.strtotime.php
            |
            */
            'past' => '3 days',
            
            /*
            |--------------------------------------------------------------------------
            | Competitions of interest.
            |--------------------------------------------------------------------------
            |
            | The list of competitions that you are interested in.
            |
            | The values for all the competitions can be found here:
            | https://docs.football-data.org/general/v4/lookup_tables.html#_league_codes
            |
            | The leagues available in the free tier are the following: Champions League,
            | Primeira Liga, Premier League, Eredivisie, Bundesliga, Ligue 1, Serie A,
            | La Liga, Championship, Serie A BR, Worldcup, Euro.
            |
            */
            'competitions' => ['PD', 'PL', 'FL1', 'BL1', 'CL', 'SA'],

            /*
            |--------------------------------------------------------------------------
            | Priority Football teams.
            |--------------------------------------------------------------------------
            |
            | A list of the teams you consider a priority across the tracked competitions.
            |
            | You must use the team acronym, ex. use `PSG` for Paris St. Germain.
            |
            */
            'priority' => [
                'FCB',
                'MCI',
                'LIV',
                'PSG',
                'RBL',
            ],
        ],
    ],
];

```

## Usage

This package contains multiple tiles to display information from [Football-data.org](https://www.football-data.org/), the usage will be broken down per tile.

In your dashboard view you use the `livewire:football-data-advanced` component.

```html
<x-dashboard>
    <livewire:football-data-advanced position="e7:e16" />
</x-dashboard>
```

## Testing

``` bash
composer test
```

## Changelog

Please see [CHANGELOG](https://github.com/VictorAvelar/laravel-dashboard-football-data-advanced/releases) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/spatie/.github/blob/main/CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email deltatuts@gmail.com instead of using the issue tracker.

## Credits

- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
