<?php

namespace Avelar\FootballDataAdvanced\Components;

use Livewire\Component;
use Avelar\FootballDataAdvanced\Stores\LeagueStandingsStore;
use Avelar\FootballDataAdvanced\Config;

class LeagueStandingsTileComponent extends Component
{
    public string $position;

    public string $competition;

    public function mount(string $position, string $competition)
    {
        $this->position = $position;
        $this->competition = $competition;
    }

    public function render()
    {
        $refreshRate = $this->refreshInSeconds
            ?? Config::value('refresh_interval_in_seconds')
            ?? 60;

        return view('dashboard-football-data-advanced::standings', [
            'data' => LeagueStandingsStore::make($this->competition)->standings(),
            'priorityList' => Config::value(Config::PRIORITY),
            'refreshIntervalInSeconds' => $refreshRate,
        ]);
    }
}
