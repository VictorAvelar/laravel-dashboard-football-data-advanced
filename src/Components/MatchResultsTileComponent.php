<?php

namespace Avelar\FootballDataAdvanced\Components;

use Avelar\FootballDataAdvanced\Config;
use Avelar\FootballDataAdvanced\Stores\MatchResultsStore;
use Livewire\Component;

class MatchResultsTileComponent extends Component
{
    public string $position;

    public function mount(string $position)
    {
        $this->position = $position;
    }

    public function render()
    {
        $refreshRate = $this->refreshInSeconds
                ?? Config::value('refresh_interval_in_seconds')
                ?? 60;

        return view(
            'dashboard-football-data-advanced::results',
            array_merge(
                [
                'refreshIntervalInSeconds' => $refreshRate,
                ],
                MatchResultsStore::make()->matchResults()
            )
        );
    }
}
