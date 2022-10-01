<?php

namespace Avelar\FootballDataAdvanced\Components;

use Livewire\Component;
use Avelar\FootballDataAdvanced\Stores\UpcomingFootballMatchesStore;

class UpcomingMatchesTileComponent extends Component
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
            'dashboard-football-data-advanced::upcoming',
            array_merge(
                [
                'refreshIntervalInSeconds' => $refreshRate,
                ],
                UpcomingFootballMatchesStore::make()->upcomingMatches()
            )
        );
    }
}
