<?php

namespace Avelar\FootballDataAdvanced\Commands;

use Illuminate\Support\Facades\Http;
use Illuminate\Console\Command;
use Avelar\FootballDataAdvanced\Stores\MatchResultsStore;
use Avelar\FootballDataAdvanced\Config;

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

        $limit = Config::value(Config::PAST);

        $params = [
            'dateTo' => now()->format('Y-m-d'),
            'dateFrom' => date('Y-m-d', strtotime("-{$limit}")),
        ];

        if (!empty(Config::value(Config::COMPETITIONS))) {
            $params['competitions'] = implode(
                ',',
                Config::value(Config::COMPETITIONS)
            );
        }

        $matches = Http::withHeaders([
            'X-Auth-token' => Config::value(Config::API_KEY),
            ])
            ->get('https://api.football-data.org/v4/matches', $params)
            ->json();

        MatchResultsStore::make()->updateMatchResults($matches['matches']);

        $this->info('Data import finished!');
    }
}
