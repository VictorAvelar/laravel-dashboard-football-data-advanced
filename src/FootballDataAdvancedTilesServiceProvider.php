<?php

namespace Avelar\FootballDataAdvanced;

use Livewire\Livewire;
use Illuminate\Support\ServiceProvider;
use Avelar\FootballDataAdvanced\Components\UpcomingMatchesTileComponent;
use Avelar\FootballDataAdvanced\Components\MatchResultsTileComponent;
use Avelar\FootballDataAdvanced\Components\LeagueStandingsTileComponent;
use Avelar\FootballDataAdvanced\Commands\FetchUpcomingFootballMatchesCommand;
use Avelar\FootballDataAdvanced\Commands\FetchMatchResultsCommand;
use Avelar\FootballDataAdvanced\Commands\FetchLeaguesStandingsCommand;

class FootballDataAdvancedServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                FetchMatchResultsCommand::class,
                FetchUpcomingFootballMatchesCommand::class,
                FetchLeaguesStandingsCommand::class,
            ]);
        }

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path(
                'views/vendor/dashdoard-football-data-advanced'
            ),
        ], 'dashboard-football-data-advanced-tiles');

        $this->loadViewsFrom(
            __DIR__ . '/../resoruces/views',
            'dashboard-football-data-advanced',
        );

        Livewire::component('fda-standings', LeagueStandingsTileComponent::class);
        Livewire::component('fda-results', MatchResultsTileComponent::class);
        Livewire::component('fda-upcoming', UpcomingMatchesTileComponent::class);
    }
}
