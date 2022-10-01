<?php

namespace Avelar\FootballDataAdvanced\Commands;

use Illuminate\Support\Facades\Http;
use Avelar\FootballDataAdvanced\Stores\LeagueStandingsStore;
use Avelar\FootballDataAdvanced\Config;

class FetchLeagueStandingsCommand extends Command
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
        $competitions = Config::value(Config::COMPETITIONS);

        foreach ($competitions as $competition) {
            $teams = Http::withHeaders([
                'X-Auth-token' => Config::value(Config::API_KEY),
            ])
                ->get("https://api.football-data.org/v4/competitions/$competition/standings")
                ->json();

            LeagueStandingsStore::make($competition)
                ->updateLeagueStandings($teams['standings']);
        }

        $this->info('All competitions updated');
    }
}
