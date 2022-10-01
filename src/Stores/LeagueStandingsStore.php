<?php

namespace Avelar\FootballDataAdvanced\Stores;

use Spatie\Dashboard\Models\Tile;

class LeagueStandingsStore
{
    public Tile $tile;

    public static function make(string $competition)
    {
        return new static($competition);
    }

    public function __construct(string $competition)
    {
        $this->tile = Tile::firstOrCreateForName(
            "league_standings_$competition"
        );
    }

    public function updateLeagueStandings(array $standings)
    {
        $this->tile->putData('standings', $standings[0]['table'] ?? []);
    }

    public function standings(): array
    {
        return collect($this->tile->getData('standings') ?? [])
            ->toArray();
    }
}
