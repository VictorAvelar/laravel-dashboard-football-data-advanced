<?php

namespace Avelar\FootballDataAdvanced\Commands;

use Illuminate\Support\Facades\Http;
use Illuminate\Console\Command;
use Avelar\FootballDataAdvanced\Stores\UpcomingFootballMatchesStore;
use Avelar\FootballDataAdvanced\Config;

class FetchUpcomingFootballMatchesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dashboard:fetch-football-matches';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch upcoming football matches.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Fetching football matches');

        $limit = Config::value(Config::FUTURE);

        $params = [
            'dateFrom' => now()->format('Y-m-d'),
            'dateTo' => date('Y-m-d', strtotime("+{$limit}")),
        ];

        if (!empty(Config::value(Config::COMPETITIONS))) {
            $params['competitions'] = implode(
                ',',
                Config::value(Config::COMPETITIONS)
            );
        }

        $matches = Http::withHeaders(
            ['X-Auth-token' => Config::value(Config::API_KEY)]
        )
            ->get('https://api.football-data.org/v4/matches', $params)
            ->json();

        UpcomingFootballMatchesStore::make()
            ->updateUpcomingMatches($matches['matches']);

        $this->info('Data import finished!');
    }
}
