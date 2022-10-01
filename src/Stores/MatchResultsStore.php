<?php

namespace Avelar\FootballDataAdvanced\Stores;

use Spatie\Dashboard\Models\Tile;
use Carbon\Carbon;

class MatchResultsStore
{
    public Tile $tile;

    public static function make()
    {
        return new static();
    }

    public function __construct()
    {
        $this->tile = Tile::firstOrCreateForName('football_data_results');
    }

    public function updateMatchResults(array $results)
    {
        $matches = collect($results);
        $data = $matches->map(function ($item) {
            $date = Carbon::parse(
                $item['utcDate']
            )->timezone(
                env('APP_TZ', 'UTC')
                )->format('c');

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
                'result' => $item['score']['fullTime'] ?? $item['score']['halfTime'],
                'date' => $date,
            ];
        })->toArray();

        $this->tile->putData('results', $data);
    }

    public function matchResults(): array
    {
        $data = $this->tile->getData('results');

        $priority = collect($data)->filter(function ($item) {
            return in_array(
                $item['home']['tla'],
                config('dashboard.tiles.football_data_advanced.priority')
                ) or
                in_array(
                    $item['away']['tla'],
                    config('dashboard.tiles.football_data_advanced.priority')
                );
        })->toArray();

        return [
            'data' => $data,
            'priority' => $priority,
        ];
    }
}
