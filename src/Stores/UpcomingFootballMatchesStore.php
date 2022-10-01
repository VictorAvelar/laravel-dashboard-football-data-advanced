<?php

namespace Avelar\FootballDataAdvanced\Stores;

use Avelar\FootballDataAdvanced\Config;
use Carbon\Carbon;
use Spatie\Dashboard\Models\Tile;

class UpcomingFootballMatchesStore
{
    public Tile $tile;

    public static function make()
    {
        return new static();
    }

    public function __construct()
    {
        $this->tile = Tile::firstOrCreateForName('football_data_upcoming');
    }

    public function updateUpcomingMatches(array $matches)
    {
        $matches = collect($matches);
        $data = $matches->map(function ($item) {
            $date = Carbon::parse($item['utcDate'])->timezone(env('APP_TZ', 'UTC'))->format('c');

            return [
                'home' => [
                    'name' => $item['homeTeam']['shortName'],
                    'tla' => $item['homeTeam']['tla'],
                    'crest' => $item['homeTeam']['crest'],
                ],
                'away' => [
                    'name' => $item['awayTeam']['shortName'],
                    'tla' => $item['awayTeam']['tla'],
                    'crest' => $item['awayTeam']['crest'],
                ],
                'date' => $date,
            ];
        })->toArray();

        $this->tile->putData('upcoming', $data);
    }

    public function upcomingMatches(): array
    {
        $data = $this->tile->getData('football_data_upcoming');
        $priority = collect($data)->filter(function ($item) {
            return in_array(
                $item['home']['tla'],
                Config::value(Config::PRIORITY)
            )
             or
                in_array(
                    $item['away']['tla'],
                    Config::value(Config::PRIORITY)
                );
        })->toArray();

        return [
            'data' => $data,
            'priority' => $priority,
        ];
    }
}
