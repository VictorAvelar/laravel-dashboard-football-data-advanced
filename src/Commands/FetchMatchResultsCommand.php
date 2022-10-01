<?php

namespace Avelar\FootballDataAdvanced\Commands;

use Illuminate\Support\Facades\Http;
use Illuminate\Console\Command;
use Avelar\FootballDataAdvanced\Stores\MatchResultsStore;

class FetchMatchResultsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dashboard:fetch-match-results';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch football-data match results.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Fetching football matches');

        $limit = config('football-data.past');

        $params = [
            'dateTo' => now()->format('Y-m-d'),
            'dateFrom' => date('Y-m-d', strtotime("-{$limit}")),
        ];

        if (!empty(config(
            'dashboard.tiles.football_data_advanced.competitions'
            ))
        ) {
            $params['competitions'] = implode(
                ',',
                config('dashboard.tiles.football_data_advanced.competitions')
            );
        }

        $matches = Http::withHeaders(['X-Auth-token' => config('dashboard.tiles.football_data_advanced.api-key')])
            ->get('https://api.football-data.org/v4/matches', $params)
            ->json();

        MatchResultsStore::make()->updateMatchResults($matches['matches']);

        $this->info('Data import finished!');
    }
}
