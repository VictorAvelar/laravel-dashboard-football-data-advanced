<?php

namespace Avelar\FootballDataAdvanced\Commands;

use Illuminate\Support\Facades\Http;
use Avelar\FootballDataAdvanced\Stores\LeagueStandingsStore;

class FetchLeaguesStandingsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dashboard:fetch-leagues-standings';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch desired competitions standings.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $competitions = config(
            'dashboard.tiles.football_data_advanced.competitions'
        );

        foreach ($competitions as $competition) {
            $teams = Http::withHeaders([
                'X-Auth-token' => config(
                    'dashboard.tiles.football_data_advanced.api-key'
                ),
            ])
                ->get("https://api.football-data.org/v4/competitions/$competition/standings")
                ->json();

            LeagueStandingsStore::make($competition)
                ->updateLeagueStandings($teams['standings']);
        }

        $this->info('All competitions updated');
    }
}
